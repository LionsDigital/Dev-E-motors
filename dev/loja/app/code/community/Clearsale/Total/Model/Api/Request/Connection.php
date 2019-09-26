<?php

class Clearsale_Total_Model_Api_Request_Connection implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $company;
    private $identificationNumber;
    private $date;
    private $seatClass;
    private $origin;
    private $destination;
    private $boarding;
    private $arriving;
    private $fareClass;

    /**
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     *
     * @return string
     */
    public function getIdentificationNumber()
    {
        return $this->identificationNumber;
    }

    /**
     *
     * @return object
     */
    public function getDate()
    {
        return $this->date;
    }

    public function getSeatClass()
    {
        return $this->seatClass;
    }

    /**
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     *
     * @return string
     */
    public function getBoarding()
    {
        return $this->boarding;
    }

    /**
     *
     * @return string
     */
    public function getArriving()
    {
        return $this->arriving;
    }

    /**
     *
     * @return string
     */
    public function getFareClass()
    {
        return $this->fareClass;
    }

    /**
     *
     * @param string $company
     * @return Connection
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     *
     * @param string $identificationNumber
     * @return Connection
     */
    public function setIdentificationNumber($identificationNumber)
    {
        $this->identificationNumber = $identificationNumber;
    }

    /**
     *
     * @param DateTime $date
     * @return Connection
     */
    public function setDate(DateTime $date)
    {
        if (empty($date)) {
            throw new InvalidArgumentException('Date is empty!');
        }

        $this->date = $date->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param string $identificationNumber
     * @return Connection
     */
    public function setSeatClass($seatClass)
    {
        $this->seatClass = $seatClass;
    }

    /**
     *
     * @param string $origin
     * @return Connection
     */
    public function setOrigin($origin)
    {
        if (empty($origin)) {
            throw new InvalidArgumentException('Origin is empty!');
        }

        $this->origin = $origin;
    }

    /**
     *
     * @param string $destination
     * @return Connection
     */
    public function setDestination($destination)
    {
        if (empty($destination)) {
            throw new InvalidArgumentException('Destination is empty!');
        }

        $this->destination = $destination;
    }

    /**
     *
     * @param string $boarding
     * @return Connection
     */
    public function setBoarding(DateTime $boarding)
    {
        if (empty($boarding)) {
            throw new InvalidArgumentException('Boarding is empty!');
        }

        $this->boarding = $boarding->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param DateTime $arriving
     * @return Connection
     */
    public function setArriving(DateTime $arriving)
    {
        if (empty($arriving)) {
            throw new InvalidArgumentException('Arriving is empty!');
        }

        $this->arriving = $arriving->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param string $arriving
     * @return Connection
     */
    public function setFareClass(DateTime $fareClass)
    {
        $this->fareClass = $fareClass->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
