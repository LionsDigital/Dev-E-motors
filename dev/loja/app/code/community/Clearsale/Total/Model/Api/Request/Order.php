<?php

class Clearsale_Total_Model_Api_Request_Order implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const DATE_TIME_FORMAT = 'Y-m-d\TH:i:s';
    const ECOMMERCE_B2B = 'b2b';
    const ECOMMERCE_B2C = 'b2c';
    const IP_DEFAULT = '127.0.0.1';

    private static $ecommerceTypes = array(
        self::ECOMMERCE_B2B,
        self::ECOMMERCE_B2C,
    );

    const STATUS_NOVO = 0;
    const STATUS_APROVADO = 9;
    const STATUS_CANCELADO = 41;
    const STATUS_REPROVADO = 45;

    private static $statuses = array(
        self::STATUS_NOVO,
        self::STATUS_APROVADO,
        self::STATUS_CANCELADO,
        self::STATUS_REPROVADO,
    );

    const PRODUCT_A_CLEAR_SALE = 1;
    const PRODUCT_M_CLEAR_SALE = 2;
    const PRODUCT_T_CLEAR_SALE = 3;
    const PRODUCT_TG_CLEAR_SALE = 4;
    const PRODUCT_TH_CLEAR_SALE = 5;
    const PRODUCT_TG_LIGHT_CLEAR_SALE = 6;
    const PRODUCT_TG_FULL_CLEAR_SALE = 7;
    const PRODUCT_T_MONITORADO = 8;
    const PRODUCT_SCORE_DE_FRAUDE = 9;
    const PRODUCT_CLEAR_ID = 10;
    const PRODUCT_ANALISE_INTERNACIONAL = 11;

    private static $products = array(
        self::PRODUCT_A_CLEAR_SALE,
        self::PRODUCT_M_CLEAR_SALE,
        self::PRODUCT_T_CLEAR_SALE,
        self::PRODUCT_TG_CLEAR_SALE,
        self::PRODUCT_TH_CLEAR_SALE,
        self::PRODUCT_TG_LIGHT_CLEAR_SALE,
        self::PRODUCT_TG_FULL_CLEAR_SALE,
        self::PRODUCT_T_MONITORADO,
        self::PRODUCT_SCORE_DE_FRAUDE,
        self::PRODUCT_CLEAR_ID,
        self::PRODUCT_ANALISE_INTERNACIONAL,
    );

    const LIST_TYPE_NAO_CADASTRADA = 1;
    const LIST_TYPE_CHA_DE_BEBE = 2;
    const LIST_TYPE_CASAMENTO = 3;
    const LIST_TYPE_DESEJOS = 4;
    const LIST_TYPE_ANIVERSARIO = 5;
    const LIST_TYPE_CHA_BAR_OU_CHA_PANELA = 6;

    private $sessionID;
    private $code;
    private $date;
    private $email;
    private $b2bb2c;
    private $itemValue;
    private $totalValue;
    private $numberOfInstallments;
    private $ip;
    private $isGift;
    private $giftMessage;
    private $observation;
    private $status;
    private $origin;
    private $channelID;
    private $reservationDate;
    private $country;
    private $nationality;
    private $product;
    private $customSla;
    private $bankAuthentication;
    private $list;
    private $purchaseInformation;
    private $billing;
    private $shipping;
    private $payments;
    private $items;
    private $passengers;
    private $connection;
    private $hotel;
    private $socialNetwork;

    public function getSessionID()
    {
        return $this->sessionID;
    }

    public function setSessionID($sessionID)
    {
        if (empty($sessionID)) {
            throw new InvalidArgumentException('SessionID is empty!');
        }

        $this->sessionID = $sessionID;
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

    /**
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     *
     * @param DateTime $date
     * @return Order
     */
    public function setDate(DateTime $date)
    {
        if (empty($date)) {
            throw new InvalidArgumentException('Date is empty!');
        }

        $timezone = Mage::getStoreConfig('general/locale/timezone');
        $date = $date->setTimezone(new DateTimeZone($timezone));
        $date = $date->format('Y-m-d H:i:s');
        $this->date = $date;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            throw new InvalidArgumentException('E-mail is empty!');
        }

        $this->email = $email;
    }

    public function getB2bB2c()
    {
        return $this->b2bb2c;
    }

    public function setB2bB2c($b2bb2c)
    {
        if (!in_array($b2bb2c, self::$ecommerceTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid ecommerce type (%s)', $ecommerceType));
        }

        $this->b2bb2c = $b2bb2c;
    }

    public function getItemValue()
    {
        return $this->itemValue;
    }

    public function setItemValue($itemValue)
    {
        $this->itemValue = $itemValue;
    }

    public function getTotalValue()
    {
        return $this->totalValue;
    }

    public function setTotalValue($totalValue)
    {

        if (empty($totalValue)) {
            throw new InvalidArgumentException('Total value is empty!');
        }

        $this->totalValue = $totalValue;
    }

    public function getNumberOfInstallments()
    {
        return $this->numberOfInstallments;
    }

    public function setNumberOfInstallments($numberOfInstallments)
    {
        $this->numberOfInstallments = $numberOfInstallments;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getIsGift()
    {
        return $this->isGift;
    }

    public function setIsGift($isGift)
    {
        $this->isGift = $isGift;
    }

    public function getGiftMessage()
    {
        return $this->giftMessage;
    }

    public function setGiftMessage($giftMessage)
    {
        $this->giftMessage = $giftMessage;
    }

    public function getObservation()
    {
        return $this->observation;
    }

    public function setObservation($observations)
    {
        $this->observation = $observations;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        if (!array_key_exists($status, self::$statuses)) {
            throw new InvalidArgumentException(sprintf('Invalid status (%s)', $status));
        }

        $this->status = $status;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    public function getChannelID()
    {
        return $this->channelID;
    }

    public function setChannelID($channelID)
    {
        $this->channelID = $channelID;
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
     * @param DateTime $reservationDate
     * @return Order
     */
    public function setReservationDate(DateTime $reservationDate)
    {
        $this->reservationDate = $reservationDate->format(self::DATE_TIME_FORMAT);
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        if (!array_key_exists($product, self::$products)) {
            throw new InvalidArgumentException(sprintf('Invalid product type (%s)', $product));
        }

        $this->product = $product;
    }

    public function getCustomSla()
    {
        return $this->customSla;
    }

    public function setCustomSla($customSla)
    {
        $this->customSla = $customSla;
    }

    public function getBankAuthentication()
    {
        return $this->bankAuthentication;
    }

    public function setBankAuthentication($bankAuthentication)
    {
        $this->bankAuthentication = $bankAuthentication;
    }

    public function getList()
    {
        return $this->list;
    }

    public function setList(Clearsale_Total_Model_Api_List $list)
    {
        $this->list = $list;
    }

    public function getPurchaseInformation()
    {
        return $this->purchaseInformation;
    }

    public function setPurchaseInformation($purchaseInformation)
    {
        return $this->purchaseInformation = $purchaseInformation;
    }

    public function addPurchaseInformation(Clearsale_Total_Model_Api_Request_PurchaseInformation $purchaseInformation)
    {
        $this->purchaseInformation[] = $purchaseInformation;
    }

    /**
     *
     * @return billingData
     */
    public function getBillingData()
    {
        return $this->billingData;
    }

    /**
     *
     * @param Clearsale_Total_Model_Api_Request_Billing $billingData
     * @return Order
     */
    public function setBillingData(Clearsale_Total_Model_Api_Request_Billing $billingData)
    {
        if (empty($billingData)) {
            throw new InvalidArgumentException('Billing is empty!');
        }

        $this->billing = $billingData;
    }

    /**
     *
     * @return shippingData
     */
    public function getShippingData()
    {
        return $this->shippingData;
    }

    /**
     *
     * @param Clearsale_Total_Model_Api_Request_Shipping $customerShippingData
     * @return Order
     */
    public function setShippingData(Clearsale_Total_Model_Api_Request_Shipping $shippingData)
    {
        if (empty($shippingData)) {
            throw new InvalidArgumentException('Shipping is empty!');
        }

        $this->shipping = $shippingData;
    }

    /**
     *
     * @return Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     *
     * @param int $index
     * @return Payment
     */
    public function getPayment($index)
    {
        return $this->payments[$index];
    }

    /**
     *
     * @param Payment[] $payments
     * @return Order
     */
    public function setPayments($payments)
    {

        if (empty($payments)) {
            throw new InvalidArgumentException('Payments is empty!');
        }

        foreach ($payments as $payment) {
            $this->addPayment($payment);
        }
    }

    /**
     *
     * @param Payment $payment
     * @return Order
     */
    public function addPayment(ClearSale_Total_Model_Api_Request_Payment $payment)
    {
        $this->payments[] = $payment;
    }

    /**
     *
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     *
     * @param Item[] $items
     * @return Order
     */
    public function setItems($items)
    {

        if (empty($items)) {
            throw new InvalidArgumentException('items is empty!');
        }

        foreach ($items as $item) {
            $this->addItems($item);
        }
    }

    /**
     *
     * @param Item $item
     * @return Order
     */
    public function addItem(ClearSale_Total_Model_Api_Request_Item $item)
    {
        $this->items[] = $item;
    }

    /**
     *
     * @return Passenger[]
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     *
     * @param Passenger[] $passengers
     * @return Order
     */
    public function setPassengers($passengers)
    {
        foreach ($passengers as $passenger) {
            $this->addPassenger($passenger);
        }
    }

    /**
     *
     * @param Passenger $passenger
     * @return Order
     */
    public function addPassenger(ClearSale_Total_Model_Api_Request_Passenger $passenger)
    {
        $this->passengers[] = $passenger;
    }

    /**
     *
     * @return Connection[]
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     *
     * @param Connection[] $connections
     * @return Order
     */
    public function setConnections($connections)
    {
        foreach ($connections as $connection) {
            $this->addConnection($connection);
        }
    }

    public function addConnection(ClearSale_Total_Model_Api_Request_Connection $connection)
    {
        $this->connection[] = $connection;
    }

    /**
     *
     * @return HotelReservation[]
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     *
     * @param HotelReservation[] $hotelReservations
     * @return Order
     */
    public function setHotels($hotels)
    {
        foreach ($hotels as $hotel) {
            $this->addHotelReservation($hotel);
        }
    }

    public function addHotel(ClearSale_Total_Model_Api_Request_Hotel $hotel)
    {
        $this->hotel[] = $hotel;
    }

    public function getSocialNetwork()
    {
        return $this->socialNetwork;
    }

    public function setSocialNetwork($socialNetworks)
    {
        foreach ($socialNetworks as $socialNetwork) {
            $this->addSocialNetwork($socialNetwork);
        }
    }

    public function addSocialNetwork(Clearsale_Total_Model_Api_Request_SocialNetwork $socialNetwork)
    {
        $this->socialNetwork[] = $socialNetwork;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
