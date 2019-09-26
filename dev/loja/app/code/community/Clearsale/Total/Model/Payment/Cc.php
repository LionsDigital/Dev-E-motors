<?php

class Clearsale_Total_Model_Payment_Cc extends Clearsale_Total_Model_Api_Request_Payment_Cc
{

    public function __construct(Mage_Sales_Model_Order_Payment $payment)
    {
        $this->setBin(!empty($payment->getNumber()) ? substr($payment->getNumber(), 0, 6) : null);
        $this->setEnd($payment->getCcLast4());
        $this->setType($this->getTypeClearSale($payment->getCcType()));
        $this->setValidityDate($this->getCcExpiration($payment->getCcExpMonth(), $payment->getCcExpYear()));
        $this->setOwnerName($payment->getCcOwner());
    }

    private function getTypeClearSale($type)
    {
        return isset(self::$cards[$type]) ? self::$cards[$type] : self::OUTROS;
    }

    protected function getCcExpiration($month, $year)
    {
        if ($month == '0' || $year == '0') {
            return null;
        }

        return $month.'/'.$year;
    }
}
