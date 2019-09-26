<?php

class Clearsale_Total_Model_Api_Request_Billing extends Clearsale_Total_Model_Api_Request_Abstract_Customer implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
