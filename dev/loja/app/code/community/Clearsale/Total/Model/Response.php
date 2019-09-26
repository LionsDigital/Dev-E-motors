<?php

class Clearsale_Total_Model_Response extends Mage_Core_Model_Abstract
{
    private $helper;
    private $order;

    public function process($response, $incrementId = null)
    {
        $order = $this->getOrder($incrementId);

        if ($order->getId()) {
            switch ($response) {
                case Clearsale_Total_Model_Api_Analysis::APROVADO:
                    $this->approveOrder();
                    break;
                case Clearsale_Total_Model_Api_Analysis::REPROVADO:
                    $this->reproveOrder();
                    break;
                default:
                    $this->putOrderInReview();
            }

            $order->setCsStatus($response);
            $order->save();
            return true;
        }

        return false;
    }

    public function getOrder($incrementId)
    {
        if (!$this->order) {
            $this->order = Mage::getModel('sales/order')->loadByIncrementId($incrementId);
        }

        return $this->order;
    }

    private function approveOrder()
    {
        $comment = $this->getHelper()->__('Payment accepted by ClearSale');
        $this->order->setState(
            Mage_Sales_Model_Order::STATE_PROCESSING,
            $this->getHelper()->getApprovedStatusCode(),
            $comment
        );

        $this->generateInvoice();
    }

    private function generateInvoice()
    {
        if (!$this->order->canInvoice()) {
            return false;
        }

        $invoice = Mage::getModel('sales/service_order', $this->order)->prepareInvoice();
        $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
        $invoice->register();

        $transactionSave = Mage::getModel('core/resource_transaction')
            ->addObject($invoice)
            ->addObject($invoice->getOrder());

        $transactionSave->save();

        $invoice->sendEmail(true);
        $invoice->setEmailSent(true);
    }

    private function reproveOrder()
    {
        if ($this->getHelper()->isAutoCancelEnabled()) {
            $comment = $this->getHelper()->__('Payment denied by ClearSale');
            $this->order->cancel();
            $this->setState(
                Mage_Sales_Model_Order::STATE_CANCELED,
                $this->getHelper()->getReprovedStatusCode(),
                $comment
            );
        }
    }

    private function putOrderInReview()
    {
        if ($this->order->getStatus() == $this->getHelper()->getReviewStatusCode()) {
            return;
        }

        $comment = $this->getHelper()->__('Payment in review by ClearSale');
        $this->order->setState(
            Mage_Sales_Model_Order::STATE_PENDING_PAYMENT,
            $this->getHelper()->getReviewStatusCode(),
            $comment
        );
    }

    private function getHelper()
    {
        if (!$this->helper) {
            $this->helper = Mage::helper('clearsale_total');
        }

        return $this->helper;
    }
}
