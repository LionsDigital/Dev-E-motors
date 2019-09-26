<?php

trait Clearsale_Total_Model_Trait_Customer
{
    protected function getCustomerType($order)
    {
        if ($this->isTaxVatACpf($order->getCustomerTaxvat())) {
            return Clearsale_Total_Model_Api_Request_Abstract_Customer::TYPE_PESSOA_FISICA;
        } else {
            return Clearsale_Total_Model_Api_Request_Abstract_Customer::TYPE_PESSOA_JURIDICA;
        }

        return Clearsale_Total_Model_Api_Request_Abstract_Customer::TYPE_PESSOA_FISICA;
    }

    protected function getCustomerGender(Mage_Customer_Model_Customer $customer, Mage_Sales_Model_Order $order = null)
    {
        $gender = $customer->getGender();

        if ($order && $order->getCustomerIsGuest()) {
            $gender = $order->getCustomerGender();
        }

        $gender = $customer->getResource()
            ->getAttribute('gender')
            ->getSource()
            ->getOptionText($gender);

        if (!$gender) {
            return Clearsale_Total_Model_Api_Request_Abstract_Customer::GENDER_MASCULINO;
        }

        return strtoupper(substr($gender, 0, 1));
    }

    protected function buildCustomerData(Mage_Sales_Model_Order $order, Mage_Customer_Model_Customer $customer, $type = null)
    {
        $this->setType($this->getCustomerType($order));
        $this->setName($order->getCustomerName());
        $this->setEmail($order->getCustomerEmail());
        $this->setGender($this->getCustomerGender($customer, $order));
        $this->setPrimaryDocument($order->getCustomerTaxvat());
        $this->setSecondaryDocument('5621785');

        if ($customer->getDob()) {
            $this->setBirthDate($customer->getDob());
        }

        if ($type == 'billing') {
            $this->addPhone(Mage::getModel('clearsale_total/phone', $order->getBillingAddress()->getTelephone()));
        }

        if ($type == 'shipping') {
            $this->addPhone(Mage::getModel('clearsale_total/phone', $order->getShippingAddress()->getTelephone()));
        }
    }

    protected function isTaxVatACpf($taxVat)
    {
        $taxVat = preg_replace('/[^0-9]/', '', $taxVat);
        return strlen($taxVat) === 11;
    }
}
