<?php

class Clearsale_Total_Model_Api_Request_Phone implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const NAO_DEFINIDO = 0;
    const RESIDENCIAL  = 1;
    const COMERCIAL    = 2;
    const RECADOS      = 3;
    const COBRANCA     = 4;
    const TEMPORARIO   = 5;
    const CELULAR      = 6;

    private static $types = array(
        self::NAO_DEFINIDO,
        self::RESIDENCIAL,
        self::COMERCIAL,
        self::RECADOS,
        self::COBRANCA,
        self::TEMPORARIO,
        self::CELULAR,
    );
    private $type;
    private $ddi;
    private $ddd;
    private $number;
    private $extension;

    public function getDDI()
    {
        return $this->ddi;
    }

    public function setDDI($ddi)
    {
        $ddi = preg_replace('/[^0-9]/', '', $ddi);

        if (strlen($ddi) < 1 || strlen($ddi) > 3) {
            throw new InvalidArgumentException(sprintf('Invalid DDI', $ddi));
        }

        $this->ddi = (int) $ddi;
    }

    public function getDDD()
    {
        return $this->ddd;
    }

    public function setDDD($ddd)
    {
        $ddd = preg_replace('/[^0-9]/', '', $ddd);

        if (strlen($ddd) != 2) {
            throw new InvalidArgumentException(sprintf('Invalid DDD', $ddd));
        }

        $this->ddd = (int)$ddd;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (strlen($number) != 9 && strlen($number) != 8) {
            throw new InvalidArgumentException(sprintf('Invalid Number', $number));
        }

        $this->number = (int)$number;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {

        if (!array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = 1;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
