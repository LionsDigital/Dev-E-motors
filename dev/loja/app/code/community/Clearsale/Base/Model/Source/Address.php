<?php

class Clearsale_Base_Model_Source_Address
{
    public function toOptionArray()
    {
        return
            array(
                1 => Mage::helper('clearsale_base')->__('Street 1'),
                2 => Mage::helper('clearsale_base')->__('Street 2'),
                3 => Mage::helper('clearsale_base')->__('Street 3'),
                4 => Mage::helper('clearsale_base')->__('Street 4')
            );
    }
}
