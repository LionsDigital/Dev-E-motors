<?php

class Clearsale_Total_Model_Api_Environment_Production extends Clearsale_Total_Model_Api_Environment_AbstractEnvironment
{
    public function __construct($login, $password)
    {
        $this->apiUrl = Mage::helper('clearsale_total')->getApiProductionUrl();
        parent::__construct($login, $password);
    }
}
