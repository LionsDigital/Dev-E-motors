<?php

class Clearsale_Total_Model_Api_Request_PurchaseInformation implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $lastDateInsertedMail;
    private $lastDateChangePassword;
    private $lastDateChangePhone;
    private $lastDateChangeMobilePhone;
    private $lastDateInsertedAddress;
    private $purchaseLogged;
    private $email;
    private $login;

    /**
     *
     * @return string
     */
    public function getLastDateInsertedMail()
    {
        return $this->lastDateInsertedMail;
    }

    /**
     *
     * @param string $lastDateInsertedMail
     * @return PurchaseInformation
     */
    public function setLastDateInsertedMail($lastDateInsertedMail)
    {
        $this->lastDateInsertedMail = $lastDateInsertedMail;
    }

    /**
     *
     * @return string
     */
    public function getLastDateChangePassword()
    {
        return $this->lastDateChangePassword;
    }

    /**
     *
     * @param string $lastDateChangePassword
     * @return PurchaseInformation
     */
    public function setLastDateChangePassword($lastDateChangePassword)
    {
        $this->lastDateChangePassword = $lastDateChangePassword;
    }

    /**
     *
     * @return string
     */
    public function getLastDateChangePhone()
    {
        return $this->lastDateChangePhone;
    }

    /**
     *
     * @param string $lastDateChangePhone
     * @return PurchaseInformation
     */
    public function setLastDateChangePhone($lastDateChangePhone)
    {
        $this->lastDateChangePhone = $lastDateChangePhone;
    }

    /**
     *
     * @return string
     */
    public function getLastDateChangeMobilePhone()
    {
        return $this->lastDateChangeMobilePhone;
    }

    /**
     *
     * @param string $lastDateChangeMobilePhone
     * @return PurchaseInformation
     */
    public function setLastDateChangeMobilePhone($lastDateChangeMobilePhone)
    {
        $this->lastDateChangeMobilePhone = $lastDateChangeMobilePhone;
    }

    /**
     *
     * @return string
     */
    public function getLastDateInsertedAddress()
    {
        return $this->lastDateInsertedAddress;
    }

    /**
     *
     * @param string $lastDateInsertedAddress
     * @return PurchaseInformation
     */
    public function setLastDateInsertedAddress($lastDateInsertedAddress)
    {
        $this->lastDateInsertedAddress = $lastDateInsertedAddress;
    }

    /**
     *
     * @return string
     */
    public function getPurchaseLogged()
    {
        return $this->purchaseLogged;
    }

    /**
     *
     * @param string $purchaseLogged
     * @return PurchaseInformation
     */
    public function setPurchaseLogged($purchaseLogged)
    {
        $this->purchaseLogged = $purchaseLogged;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $email
     * @return PurchaseInformation
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     *
     * @param string $login
     * @return PurchaseInformation
     */
    public function setLogin($login)
    {
        $this->login = $login;
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
