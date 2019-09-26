<?php

class Clearsale_Total_Model_Resource_History_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('clearsale_total/history');
    }

    public function addOrderIdFilter($orderId)
    {
        $this->addFieldToFilter('order_id', $orderId);
        return $this;
    }
}
