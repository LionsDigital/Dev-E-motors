<?php

class Clearsale_Total_Model_Api_Request_Payment_Address extends Clearsale_Total_Model_Api_Request_Address implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
