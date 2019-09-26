<?php

trait Clearsale_Total_Model_Api_Request_Trait_ConvertToArray
{
    public function toArray()
    {
        $allowedProperties = [];
        foreach(get_object_vars($this) as $prop => $value) {

            if(!empty($value)) {
                $allowedProperties[$prop] = $value;
            }
        }

        return $allowedProperties;
    }
}
