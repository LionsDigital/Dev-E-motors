<?php

class Clearsale_Total_Model_Address extends Clearsale_Total_Model_Api_Request_Address
{
    private $helper;

    public function __construct(Mage_Sales_Model_Order_Address $address)
    {
        if (!$this->helper) {
            $this->helper = Mage::helper('clearsale_total');
        }

        $this->setStreet($this->getStreetMap($address));
        $this->setNumber($this->getNumberMap($address));
        $this->setAdditionalInformation($this->getComplementMap($address));
        $this->setCounty($this->getNeighborhoodMap($address));
        $this->setCountry($address->getCountryId());
        $this->setCity($address->getCity());
        $this->setState($address->getRegionCode());
        $this->setZipcode($address->getPostcode());
    }

    public function getStreetMap(Mage_Sales_Model_Order_Address $address)
    {
        return $address->getStreet(1);
    }

    public function getNumberMap(Mage_Sales_Model_Order_Address $address)
    {
        return ($address->getStreet($this->helper->getNumberMap()) == 0) ? 'SN' : $address->getStreet($this->helper->getNumberMap());
    }

    public function getComplementMap(Mage_Sales_Model_Order_Address $address)
    {
        return !empty($address->getStreet($this->helper->getComplementMap())) ? $address->getStreet($this->helper->getComplementMap()) : '';
    }

    public function getNeighborhoodMap(Mage_Sales_Model_Order_Address $address)
    {
        return empty($address->getStreet($this->helper->getNeighborhoodMap())) ? 'SB' : $address->getStreet($this->helper->getNeighborhoodMap());
    }
}
