<?php

class Clearsale_Total_Model_Payment extends Clearsale_Total_Model_Api_Request_Payment
{
    private $helperBase;

    public function __construct(Mage_Sales_Model_Order $order)
    {
        $this->helperBase = Mage::helper('clearsale_total/base');
        $payment = $order->getPayment();

        $this->setType($this->getPaymentType($payment->getMethod()));
        $this->setDate(new DateTime($order->getCreatedAt()));
        $this->setValue(Mage::helper('clearsale_total')->formatNumber($order->getGrandTotal()));

        if (in_array($payment->getMethod(), $this->helperBase->getPaymentsCc())) {
            $this->setCard(Mage::getModel('clearsale_total/payment_cc', $payment));
            $this->setInstallments((int) $payment->getAdditionalInformation('cc_installments'));
        }
    }

    /**
     * Get helper clearsale base
     * @return object
     */
    public function getHelperBase()
    {
        return $this->helperBase;
    }

    /**
     * Get payment type by clearsale
     * @param  string $method payment method magento
     * @return int payment method code clearsale
     */
    private function getPaymentType($method)
    {

        if (in_array($method, $this->helperBase->getPaymentsCc())) {
            return self::CARTAO_CREDITO;
        }

        if (in_array($method, $this->helperBase->getPaymentsDebit())) {
            return self::DEBITO_BANCARIO;
        }

        if (in_array($method, $this->helperBase->getPaymentsBoleto())) {
            return self::BOLETO_BANCARIO;
        }

        if (in_array($method, $this->helperBase->getPaymentsBankTransfer())) {
            return self::TRANSFERENCIA_BANCARIA;
        }

        //Paypal, deposit
        return self::OUTROS;
    }
}
