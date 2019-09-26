<?php

class Clearsale_Total_Model_Api_Request_Hotel implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $name;
    private $city;
    private $state;
    private $country;
    private $reservationDate;
    private $reservationExpirationDate;
    private $checkInDate;
    private $checkOutDate;

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return DateTime
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    /**
     *
     * @return DateTime
     */
    public function getReservationExpirationDate()
    {
        return $this->reservationExpirationDate;
    }

    /**
     *
     * @return DateTime
     */
    public function getCheckInDate()
    {
        return $this->checkInDate;
    }

    /**
     *
     * @return DateTime
     */
    public function getCheckOutDate()
    {
        return $this->checkOutDate;
    }

    /**
     *
     * @param string $name
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $city
     * @return Hotel
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     *
     * @param string $state
     * @return Hotel
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     *
     * @param string $country
     * @return Hotel
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     *
     * @param string $reservationDate
     * @return Hotel
     */
    public function setReservationDate(DateTime $reservationDate)
    {
        $this->reservationDate = $reservationDate->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param string $reservationExpirationDate
     * @return Hotel
     */
    public function setReservationExpirationDate(DateTime $reservationExpirationDate)
    {
        $this->reservationExpirationDate = $reservationExpirationDate->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param string $checkInDate
     * @return Hotel
     */
    public function setCheckInDate(DateTime $checkInDate)
    {
        $this->checkInDate = $checkInDate->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    /**
     *
     * @param string $checkOutDate
     * @return Hotel
     */
    public function setCheckOutDate(DateTime $checkOutDate)
    {
        $this->checkOutDate = $checkOutDate->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
