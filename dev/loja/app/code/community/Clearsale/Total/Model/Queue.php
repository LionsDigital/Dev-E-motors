<?php

class Clearsale_Total_Model_Queue extends Mage_Core_Model_Abstract
{
    private $helper;
    private $order;

    protected function _construct()
    {
        $this->_init('clearsale_total/queue');
    }

    public function process()
    {
        if (!$this->getHelper()->isEnabled() || !$this->getOrder()->getPayment() || $this->getOrder()->isCanceled()) {
            return;
        }

        $response = $this->sendOrders();
        if ($response) {
            $responseProcess = Mage::getModel('clearsale_total/response')->process($response, $this->getOrder()->getIncrementId());
            // If order has updated, remove item from queue
            if ($responseProcess) {
                $this->delete();
                return;
            }

            $this->setStatus('error');
        }
    }

    private function sendOrders()
    {
        try {
            $editedOrderId = null;
            if (!is_numeric($this->getOrder()->getIncrementId())) {
                $editedOrderId = preg_replace('/[^0-9]/', '', $this->getOrder()->getIncrementId());
            }
            $clearSaleOrder = new Clearsale_Total_Model_Order($this->getOrder(), $editedOrderId);
            return $this->getHelper()->getClearSale()->analysis($clearSaleOrder);
        } catch (Exception $e) {
            Mage::helper('clearsale_total/log')->error('Errors: ');
            Mage::helper('clearsale_total/log')->error($e->getMessage());
            return Clearsale_Total_Model_Api_Analysis::ERRO;
        }
    }

    public function getHelper()
    {
        if (!$this->helper) {
            $this->helper = Mage::helper('clearsale_total');
        }

        return $this->helper;
    }

    public function getOrder()
    {
        if (!$this->order) {
            $this->order = Mage::getModel('sales/order')->load($this->getOrderId());
        }

        return $this->order;
    }
}
