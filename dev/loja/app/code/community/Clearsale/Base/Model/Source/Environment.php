<?php

class Clearsale_Base_Model_Source_Environment
{
    public function toOptionArray()
    {
        return
            array(
                'staging' => Mage::helper('clearsale_base')->__('Staging'),
                'production' => Mage::helper('clearsale_base')->__('Production'),
            );
    }
}
