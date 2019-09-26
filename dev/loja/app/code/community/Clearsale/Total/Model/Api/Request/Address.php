<?php

class Clearsale_Total_Model_Api_Request_Address implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $street;
    private $number;
    private $additionalInformation;
    private $county;
    private $city;
    private $state;
    private $country;
    private $zipcode;
    private $reference;

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        if (empty($street)) {
            throw new InvalidArgumentException('Street is empty!');
        }

        $this->street = $street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        if (empty($number)) {
            throw new InvalidArgumentException('Number is empty!');
        }

        $this->number = $number;
    }

    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation($additionalInformation)
    {
        $this->additionalInformation = $additionalInformation;
    }

    public function getCounty()
    {
        return $this->county;
    }

    public function setCounty($county)
    {
        if (empty($county)) {
            throw new InvalidArgumentException('County is empty!');
        }

        $this->county = $county;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        if (empty($city)) {
            throw new InvalidArgumentException('City is empty!');
        }

        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        if (empty($state)) {
            throw new InvalidArgumentException('State is empty!');
        }

        $this->state = $state;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $countryName = Mage::getModel('directory/country')->load($country);

        if (empty($countryName->getName())) {
            throw new InvalidArgumentException('Country is empty!');
        }

        $this->country = $countryName->getName();
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipCode)
    {
        $zipCode = preg_replace('/[^0-9]/', '', $zipCode);

        if (empty($zipCode)) {
            throw new InvalidArgumentException('ZipCode is empty!');
        }

        $this->zipcode = $zipCode;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function jsonSerialize()
    {

        return $this->toArray();
    }
}
