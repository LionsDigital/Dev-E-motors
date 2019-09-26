<?php

class Clearsale_Base_Model_Source_TaxVat
{
    public function toOptionArray()
    {
        $attributes = Mage::getModel('customer/entity_attribute_collection');

        $result = array();

        foreach ($attributes as $attribute) {
            if ($attribute->getData('frontend_label') != null) {
                $result[$attribute->getData('attribute_code')] = $attribute->getData('frontend_label');
            }
        }
        return $result;
    }
}
