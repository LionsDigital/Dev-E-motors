<?php

class Clearsale_Total_Model_Api_Request_Payment_Standard implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const DINERS           = 1;
    const MASTERCARD       = 2;
    const VISA             = 3;
    const OUTROS           = 4;
    const AMERICAN_EXPRESS = 5;
    const HIPERCARD        = 6;
    const AURA             = 7;

    protected static $cards = array(
        self::MASTERCARD,
        self::VISA,
        self::OUTROS,
        self::AMERICAN_EXPRESS,
        self::HIPERCARD,
        self::AURA,
    );
    private $number;
    private $hash;
    private $bin;
    private $end;
    private $type;
    private $validityDate;
    private $ownerName;
    private $document;
    private $nsu;

    /**
     * Nsu
     * @return string
     */
    public function getNsu()
    {
        return $this->nsu;
    }

    public function setNsu($nsu)
    {
        $this->nsu = $nsu;
    }

    /**
     * Document
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * Hash
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * End number
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        if (empty($end)) {
            throw new InvalidArgumentException('End card is empty!');
        }

        $this->end = $end;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (!array_key_exists($type, self::$cards)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = $type;
    }

    public function getOwnerName()
    {
        return $this->ownerName;
    }

    public function setOwnerName($ownerName)
    {
        if (empty($ownerName)) {
            throw new InvalidArgumentException('Owner name is empty!');
        }

        $this->ownerName = $ownerName;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;
    }

    public function getValidityDate()
    {
        return $this->validityDate;
    }

    public function setValidityDate($validityDate)
    {
        $this->validityDate = $validityDate;
    }

    public function getBin()
    {
        return $this->bin;
    }

    public function setBin($bin)
    {
        $this->bin = $bin;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
