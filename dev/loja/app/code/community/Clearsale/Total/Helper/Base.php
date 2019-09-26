<?php

class Clearsale_Total_Helper_Base extends Mage_Core_Helper_Data
{
    const CODE_SETTING_BASE = 'clearsale_setting_base/';
    const CODE_ENVIRONMENT = 'clearsale_settings/environment';
    const ENV_PRODUCTION = 'production';
    const CODE_PRODUCTION_API_KEY = 'clearsale_settings/production_api_key';
    const CODE_PRODUCTION_API_PASSWORD = 'clearsale_settings/production_api_password';

    const CODE_STAGING_API_KEY = 'clearsale_settings/staging_api_key';
    const CODE_STAGING_API_PASSWORD = 'clearsale_settings/staging_api_password';

    const CODE_LOG = 'clearsale_settings/clearsale_log';

    const MAP_PAYMENT_METHODS_CC = 'clearsale_filters/clearsale_payment_methods_cc';
    const MAP_PAYMENT_METHODS_DEBIT = 'clearsale_filters/clearsale_payment_methods_debit';
    const MAP_PAYMENT_METHODS_BOLETO = 'clearsale_filters/clearsale_payment_methods_boleto';
    const MAP_PAYMENT_METHODS_PAYPAL = 'clearsale_filters/clearsale_payment_methods_paypal';
    const MAP_PAYMENT_METHODS_DEPOSIT = 'clearsale_filters/clearsale_payment_methods_deposit';
    const MAP_PAYMENT_METHODS_BANK_TRANSFER = 'clearsale_filters/clearsale_payment_methods_bank_transfer';

    public function getConfig($code)
    {
        return Mage::getStoreConfig(self::CODE_SETTING_BASE.$code);
    }

    public function getEnvironment()
    {
        return $this->getConfig(self::CODE_ENVIRONMENT);
    }

    public function getLogin()
    {
        if ($this->getEnvironment() == self::ENV_PRODUCTION) {
            return $this->getConfig(self::CODE_PRODUCTION_API_KEY);
        }

        return $this->getConfig(self::CODE_STAGING_API_KEY);
    }

    public function getPassword()
    {
        if ($this->getEnvironment() == self::ENV_PRODUCTION) {
            return $this->getConfig(self::CODE_PRODUCTION_API_PASSWORD);
        }

        return $this->getConfig(self::CODE_STAGING_API_PASSWORD);
    }

    public function isEnabledLog()
    {
        return $this->getConfig(self::CODE_LOG);
    }

    public function getPaymentsCc()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_CC));
    }

    public function getPaymentsDebit()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_DEBIT));
    }

    public function getPaymentsBoleto()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_BOLETO));
    }

    public function getPaymentsPaypal()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_PAYPAL));
    }

    public function getPaymentsDeposit()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_DEPOSIT));
    }

    public function getPaymentsBankTransfer()
    {
        return explode(',', $this->getConfig(self::MAP_PAYMENT_METHODS_BANK_TRANSFER));
    }
}
