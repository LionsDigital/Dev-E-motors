<?php

class Clearsale_Total_Model_Api_Request_Shipping extends Clearsale_Total_Model_Api_Request_Abstract_Customer implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $deliveryType;
    private $deliveryTime;
    private $price;
    private $pickUpStoreDocument;

    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;
    }

    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    public function setPrice($price)
    {
        $this->price = (float) $price;
    }

    public function setPickUpStoreDocument($pickUpStoreDocument)
    {
        $this->pickUpStoreDocument = $pickUpStoreDocument;
    }

    /**
     *
     * @return string
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     *
     * @return string
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     *
     * @return string
     */
    public function getPickUpStoreDocument()
    {
        return $this->pickUpStoreDocument;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
