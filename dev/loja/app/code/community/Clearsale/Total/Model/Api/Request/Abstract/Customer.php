<?php

abstract class Clearsale_Total_Model_Api_Request_Abstract_Customer
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const TYPE_PESSOA_FISICA = 1;
    const TYPE_PESSOA_JURIDICA = 2;

    protected static $customerTypes = array(
        self::TYPE_PESSOA_FISICA,
        self::TYPE_PESSOA_JURIDICA,
    );

    const GENDER_MASCULINO = 'M';
    const GENDER_FEMININO = 'F';

    protected static $genderTypes = array(
        self::GENDER_MASCULINO,
        self::GENDER_FEMININO,
    );

    protected $clientID;
    protected $type;
    protected $primaryDocument;
    protected $secondaryDocument;
    protected $name;
    protected $birthDate;
    protected $email;
    protected $gender;
    protected $address;
    protected $phones;

    /**
     *
     * @return string
     */
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     *
     * @param string $clientId
     * @return self
     * @throws InvalidArgumentException
     */
    public function setClientID($clientID)
    {
        if (empty($clientID)) {
            throw new InvalidArgumentException('The clientId value is empty!');
        }

        $this->clientID = $clientID;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     * @return self
     * @throws InvalidArgumentException
     */
    public function setType($type)
    {
        if (!in_array($type, self::$customerTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = $type;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPrimaryDocument()
    {
        return $this->primaryDocument;
    }

    /**
     *
     * @param string $primaryDocument
     * @return self
     * @throws InvalidArgumentException
     */
    public function setPrimaryDocument($primaryDocument)
    {
        $primaryDocument = preg_replace('/[^0-9]/', '', $primaryDocument);

        if (empty($primaryDocument)) {
            throw new InvalidArgumentException('PrimaryDocument is empty!');
        }

        $this->primaryDocument = $primaryDocument;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getSecondaryDocument()
    {
        return $this->secondaryDocument;
    }

    /**
     *
     * @param string $secondaryDocument
     * @return self
     * @throws InvalidArgumentException
     */
    public function setSecondaryDocument($secondaryDocument)
    {
        $secondaryDocument = preg_replace('/[^0-9]/', '', $secondaryDocument);

        if (empty($secondaryDocument)) {
            throw new InvalidArgumentException('SecondaryDocument is empty!');
        }

        $this->secondaryDocument = $secondaryDocument;

        return $this;
    }

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
     * @param string $name
     * @return self
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name is empty!');
        }

        $this->name = $name;

        return $this;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     *
     * @param DateTime $birthDate
     * @return self
     */
    public function setBirthDate(DateTime $birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
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
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     *
     * @param string $gender
     * @return self
     * @throws InvalidArgumentException
     */
    public function setGender($gender)
    {
        if (!in_array($gender, self::$genderTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid gender (%s)', $gender));
        }

        $this->gender = $gender;

        return $this;
    }

    /**
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     *
     * @param Clearsale_Total_Model_Api_Request_Address $address
     * @return self
     */
    public function setAddress(Clearsale_Total_Model_Api_Request_Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     *
     * @return Phone[]
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     *
     * @param Phone|Phone[] $phones
     * @return self
     */
    public function setPhones($phones)
    {
        if (empty($phones)) {
            throw new InvalidArgumentException('Phones is empty!');
        }

        foreach ((array)$phones as $phone) {
            $this->addPhone($phone);
        }

        return $this;
    }

    /**
     *
     * @param Clearsale_Total_Model_Api_Request_Phone $phone
     * @return self
     */
    public function addPhone(Clearsale_Total_Model_Api_Request_Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }
}
