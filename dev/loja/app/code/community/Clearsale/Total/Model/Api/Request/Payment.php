<?php

class Clearsale_Total_Model_Api_Request_Payment implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    const CARTAO_CREDITO           = 1;
    const BOLETO_BANCARIO          = 2;
    const DEBITO_BANCARIO          = 3;
    const DEBITO_BANCARIO_DINHEIRO = 4;
    const DEBITO_BANCARIO_CHEQUE   = 5;
    const TRANSFERENCIA_BANCARIA   = 6;
    const SEDEX_A_COBRAR           = 7;
    const CHEQUE                   = 8;
    const DINHEIRO                 = 9;
    const FINANCIAMENTO            = 10;
    const FATURA                   = 11;
    const CUPOM                    = 12;
    const MULTICHEQUE              = 13;
    const OUTROS                   = 14;

    private $sequential;
    private $date;
    private $value;
    private $type;
    private $installments;
    private $interestRate;
    private $interestValue;
    private $currency;
    private $voucherOrderOrigin;
    private $address;
    private $card;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getSequential()
    {
        return $this->sequential;
    }

    public function setSequential($sequential)
    {
        $this->sequential = $sequential;
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
     * @param DateTime $date
     * @return Payment
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date->format(Clearsale_Total_Model_Api_Request_Order::DATE_TIME_FORMAT);
    }

    public function getValue()
    {
        return $this->amount;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getInstallments()
    {
        return $this->installments;
    }

    public function setInstallments($installments)
    {
        $this->installments = $installments;
    }

    public function getInterestRate()
    {
        return $this->interestRate;
    }

    public function setInterestRate($interestRate)
    {
        $this->interestRate = $interestRate;
    }

    public function getInterestValue()
    {
        return $this->interestValue;
    }

    public function setInterestValue($interestValue)
    {
        $this->interestValue = $interestValue;
    }

    /**
     *
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     *
     * @param Card $card
     * @return Payment
     */
    public function setCard(Clearsale_Total_Model_Api_Request_Payment_Standard $card)
    {
        $this->card = $card;
    }

    public function getVoucherOrderOrigin()
    {
        return $this->voucherOrderOrigin;
    }

    public function setVoucherOrderOrigin($voucherOrderOrigin)
    {
        $this->voucherOrderOrigin = $voucherOrderOrigin;
    }

    /**
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(Clearsale_Total_Model_Api_Request_Payment_Address $address)
    {
        $this->address = $address;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(Clearsale_Total_Model_Api_Request_Type_Currency $currency)
    {
        $this->currency = $currency->toValue();
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
