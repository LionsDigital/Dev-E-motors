<?php

class Clearsale_Total_Model_PurchaseInformationData extends Clearsale_Total_Model_Api_Request_PurchaseInformation
{
    public function __construct(Mage_Sales_Model_Order $order, Mage_Customer_Model_Customer $customer)
    {
        $this->setEmail($customer->getEmail());
        $this->setLogin($customer->getEmail());
        $this->setPurchaseLogged((bool) $this->isGuest($order));
        $this->setLastDateChangePassword($this->getLastDateChangePassword($customer));
        $this->setLastDateInsertedAddress($this->getLastDateChangePassword($customer));
    }

    private function isGuest($order)
    {
        if ($order['customer_is_guest'] === '0') {
            return true;
        }
        return false;
    }

    public function getLastDateChangePassword($customer)
    {
        return $customer['updated_at'];
    }

    public function getLastDateInsertedAddress($customer)
    {
        return $customer['updated_at'];
    }
}