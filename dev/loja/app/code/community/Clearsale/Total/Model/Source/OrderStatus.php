<?php
class Clearsale_Total_Model_Source_OrderStatus
{
    public function toOptionArray()
    {
       return Mage::getModel('sales/order_status')->getCollection()->toOptionArray();
    }
}
