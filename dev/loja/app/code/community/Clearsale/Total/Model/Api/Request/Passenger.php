<?php

class Clearsale_Total_Model_Api_Request_Passenger implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const DOCUMENT_TYPE_CPF = 1;
    const DOCUMENT_TYPE_CNPJ = 2;
    const DOCUMENT_TYPE_RG = 3;
    const DOCUMENT_TYPE_IE = 4;
    const DOCUMENT_TYPE_PASSAPORTE = 5;
    const DOCUMENT_TYPE_CTPS = 6;
    const DOCUMENT_TYPE_TITULO_ELEITOR = 7;

    private $documentTypes = array(
        self::DOCUMENT_TYPE_CPF,
        self::DOCUMENT_TYPE_CNPJ,
        self::DOCUMENT_TYPE_RG,
        self::DOCUMENT_TYPE_IE,
        self::DOCUMENT_TYPE_PASSAPORTE,
        self::DOCUMENT_TYPE_CTPS,
        self::DOCUMENT_TYPE_TITULO_ELEITOR
    );

    private $name;
    private $companyMileCard;
    private $mileCard;
    private $identificationType;
    private $identificationNumber;
    private $gender;
    private $birthdate;
    private $cpf;

    public static function create($name, $legalDocumentType, $legalDocument)
    {
        $passenger = new self();
        $passenger
            ->setName($name)
            ->setLegalDocumentType($legalDocumentType)
            ->setLegalDocument($legalDocument);

        return $passenger;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCompanyMileCard()
    {
        return $this->companyMileCard;
    }

    public function getMileCard()
    {
        return $this->mileCard;
    }

    public function getIdentificationType()
    {
        return $this->identificationType;
    }

    public function getIdentificationNumber()
    {
        return $this->identificationNumber;
    }

    public function getGender()
    {
        return $this->gender;
    }

    /**
     *
     * @return DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name is empty!');
        }

        $this->name = $name;
    }

    public function setCompanyMileCard($companyMileCard)
    {
        $this->companyMileCard = $companyMileCard;
    }

    public function setMileCard($mileCard)
    {
        $this->mileCard = $mileCard;
    }

    public function setIdentificationType($identificationType)
    {
        $this->identificationType = $identificationType;
    }

    public function setIdentificationNumber($identificationNumber)
    {
        $this->identificationNumber = $identificationNumber;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

   /**
    *
    * @param DateTime $birthdate
    * @return Passengers
    */
    public function setBirthdate(DateTime $birthdate)
    {
        $this->birthdate = $birthdate->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    public function setCpf($cpf)
    {
        return $this->cpf = $cpf;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
