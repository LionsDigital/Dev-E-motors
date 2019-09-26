<?php

class Clearsale_Total_Model_Order extends Clearsale_Total_Model_Api_Request_Order
{
    public function __construct(Mage_Sales_Model_Order $order)
    {
        $customer = Mage::getModel('customer/customer')->load($order->getCustomerId());
        $helper = Mage::helper('clearsale_total');

        $email = $customer->getEmail();
        if(!$email){
            $email = $order->getCustomerEmail();
        }

        $this->setSessionID($order->getCsSessionId());
        $this->setOrigin('Ecommerce Magento');
        $this->setCode($order->getIncrementId());
        $this->setDate(new DateTime($order->getCreatedAt()));
        $this->setEmail($customer->getEmail());
        //$this->setB2bB2c('b2c');
        $this->setItemValue($helper->formatNumber($order->getSubtotal()));
        $this->setTotalValue($helper->formatNumber($order->getGrandTotal()));
        $this->setNumberOfInstallments((int) $this->getOrderQtyInstallments($order));
        $this->setIp(!empty($order->getRemoteIp()) ? $order->getRemoteIp() : self::IP_DEFAULT);
        $this->setStatus(self::STATUS_NOVO);
        $this->setProduct(self::PRODUCT_T_CLEAR_SALE);
        $this->setBillingData(new Clearsale_Total_Model_BillingData($order, $customer));
        $this->setShippingData(new Clearsale_Total_Model_ShippingData($order, $customer));
        $this->setPurchaseInformation(new Clearsale_Total_Model_PurchaseInformationData($order, $customer));
        $this->addPayment(new Clearsale_Total_Model_Payment($order));

        /** @var Mage_Sales_Model_Order_Item $item */
        foreach ($order->getAllVisibleItems() as $item) {
            $this->addItem((new Clearsale_Total_Model_Api_Request_Item())->create(
                $item->getProductId(),
                $item->getName(),
                $item->getPrice(),
                (int) $item->getQtyOrdered()
            ));
        }

    }

    private function getOrderQtyInstallments(Mage_Sales_Model_Order $order)
    {
        if ($order->getPayment()->hasData('cc_installments')) {
            return $order->getPayment()->getCcInstallments();
        }

        if ($order->getPayment()->getAdditionalInformation('cc_installments')) {
            return $order->getPayment()->getAdditionalInformation('cc_installments');
        }

        if ($order->getPayment()->getAdditionalInformation('number_of_installments')) {
            return $order->getPayment()->getAdditionalInformation('number_of_installments');
        }

        return $order->getPayment()->getAdditionalInformation('installments');
    }
}
