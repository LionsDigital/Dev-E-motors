<?php

class Clearsale_Total_Model_Api_Request_Item implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $code;
    private $name;
    private $value;
    private $amount;
    private $categoryID;
    private $categoryName;
    private $sellerName;
    private $isMarketPlace;
    private $shippingCompany;

    public function create($code, $name, $value, $amount)
    {
        $instance = new self();

        $instance->setCode($code);
        $instance->setName($name);
        $instance->setValue($value);
        $instance->setAmount($amount);

        return $instance;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        if (empty($code)) {
            throw new InvalidArgumentException('Code is empty!');
        }

        $this->code = $code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name is empty!');
        }

        $this->name = $name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if (!is_float(floatval($value))) {
            throw new InvalidArgumentException(sprintf('Invalid value %s', $value));
        }

        $this->value = (float)$value;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        if (!is_int($amount)) {
            throw new InvalidArgumentException(sprintf('Invalid amount %s', $amount));
        }

        $this->amount = $amount;
    }

    public function getCategoryID()
    {
        return $this->categoryID;
    }

    public function setCategoryID($categoryID)
    {
        if (!is_int($categoryID)) {
            throw new InvalidArgumentException(sprintf('Invalid categoryId', $categoryID));
        }

        $this->categoryID = $categoryID;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName)
    {
        if (empty($categoryName)) {
            throw new InvalidArgumentException('Category name is empty!');
        }

        $this->categoryName = $categoryName;
    }

    public function getSellerName()
    {
        return $this->sellerName;
    }

    public function setSellerName($sellerName)
    {
        if (empty($sellerName)) {
            throw new InvalidArgumentException('Seller name is empty!');
        }

        $this->sellerName = $sellerName;
    }

    public function getIsMarketPlace()
    {
        return $this->sellerName;
    }

    public function setIsMarketPlace($isMarketPlace)
    {
        $this->isMarketPlace = $isMarketPlace;
    }

    public function getShippingCompany()
    {
        return $this->shippingCompany;
    }

    public function setShippingCompany($shippingCompany)
    {
        if (empty($shippingCompany)) {
            throw new InvalidArgumentException('Shipping company is empty!');
        }

        $this->shippingCompany = $shippingCompany;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
