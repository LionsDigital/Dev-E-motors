<?php

class Clearsale_Total_Model_Phone extends Clearsale_Total_Model_Api_Request_Phone
{
    public function __construct(Mage_Sales_Model_Order_Address $address)
    {
        $phone = $this->phoneToArray($address->getTelephone());
        $this->setDDI('55');
        $this->setDDD($phone['areaCode']);
        $this->setNumber($phone['number']);
        $this->setType(self::NAO_DEFINIDO);
    }

    private function phoneToArray($phoneString)
    {
        $phoneString = str_replace(
            ['-', ' ', '(', ')'],
            '',
            $phoneString
        );

        if (strlen($phoneString) == 0 || strlen($phoneString) < 10) {
            return null;
        }

        foreach (str_split($phoneString) as $number) {
            if (!is_numeric($number)) {
                return null;
            }
        }

        if (substr($phoneString, 0, 4) == '0800') {
            return ['number' => $phoneString];
        }

        return [
            'areaCode' => substr($phoneString, 0, 2),
            'number' => substr($phoneString, 2)
        ];
    }
}
