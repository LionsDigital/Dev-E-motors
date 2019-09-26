<?php

class Clearsale_Total_Helper_Data extends Mage_Core_Helper_Data
{
    const CODE_SETTING_TOTAL = 'clearsale_setting_total/clearsale_settings_total/';
    const ENV_PRODUCTION = 'production';
    const CODE_PRODUCTION_API_URL = 'production_api_url';
    const CODE_STAGING_API_URL = 'staging_api_url';

    const CODE_REVIEW_STATUS = 'review_status_code';
    const CODE_APPROVED_STATUS = 'order_status_after_approved';
    const CODE_REPROVED_STATUS = 'order_status_after_canceled';

    const CODE_NUMBER_ORDER_PROCESS_QUEUE = 'number_orders_queue_process';
    const CODE_PAYMENT_METHODS = 'payment_methods';
    const CODE_AUTO_CANCEL_ENABLED = 'auto_cancel_enabled';
    const STATUS_LIST = [
        'AMA' => 'Análise Manual',
        'APA' => 'Aprovação Automática',
        'APM' => 'Aprovação Manual',
        'CAN' => 'Cancelado pelo Cliente',
        'ERR' => 'Erro',
        'FRD' => 'Fraude Confirmada',
        'NVO' => 'Novo',
        'RPA' => 'Reprovação Automática',
        'RPM' => 'Reprovado Sem Suspeita',
        'RPP' => 'Reprovação Por Política estabelecida pelo cliente ou ClearSale',
        'SUS' => 'Suspensão Manual'
    ];

    const CODE_BASE_ADDRESS_MAP_STEET = 'clearsale_mapping_address/clearsale_mapping_address_street';
    const CODE_BASE_ADDRESS_MAP_NUMBER = 'clearsale_mapping_address/clearsale_mapping_address_number';
    const CODE_BASE_ADDRESS_MAP_COMPLEMENT = 'clearsale_mapping_address/clearsale_mapping_address_complemento';
    const CODE_BASE_ADDRESS_MAP_NEIGHBORHOOD = 'clearsale_mapping_address/clearsale_mapping_adress_neighborhood';

    public function isEnabled()
    {
        return $this->getConfig('active');
    }

    public function formatNumber($number)
    {
        return (float)number_format($number, 4, '.', '');
    }

    public function isAutoCancelEnabled()
    {
        return $this->getConfig(self::CODE_AUTO_CANCEL_ENABLED);
    }

    public function getClearSale()
    {
        $environment = $this->getEnvironment();

        return new Clearsale_Total_Model_Api_Analysis($environment);
    }

    private function getEnvironment()
    {
        $baseEnvironment = Mage::helper('clearsale_total/base')->getEnvironment();
        if ($baseEnvironment == self::ENV_PRODUCTION) {
            return new Clearsale_Total_Model_Api_Environment_Production(Mage::helper('clearsale_total/base')->getLogin(), Mage::helper('clearsale_total/base')->getPassword());
        }

        return new Clearsale_Total_Model_Api_Environment_Sandbox(Mage::helper('clearsale_total/base')->getLogin(), Mage::helper('clearsale_total/base')->getPassword());
    }

    public function getReviewStatusCode()
    {
        return $this->getConfig(self::CODE_REVIEW_STATUS);
    }

    public function getApprovedStatusCode()
    {
        return $this->getConfig(self::CODE_APPROVED_STATUS);
    }

    public function getReprovedStatusCode()
    {
        return $this->getConfig(self::CODE_REPROVED_STATUS);
    }

    public function isPaymentMethodAccepted(Mage_Sales_Model_Order_Payment $payment)
    {
        $payments = explode(',', $this->getConfig(self::CODE_PAYMENT_METHODS));
        return in_array($payment->getMethod(), $payments);
    }

    public function getNumberOrdersToProcessQueue()
    {
        return $this->getConfig(self::CODE_NUMBER_ORDER_PROCESS_QUEUE);
    }

    public function getConfig($key)
    {
        return Mage::getStoreConfig(self::CODE_SETTING_TOTAL . $key);
    }

    public function getApiProductionUrl()
    {
        return $this->getConfig(self::CODE_PRODUCTION_API_URL);
    }

    public function getApiStagingUrl()
    {
        return $this->getConfig(self::CODE_STAGING_API_URL);
    }

    public function getStatusList()
    {
        return self::STATUS_LIST;
    }

    public function getStreetMap()
    {
        return Mage::helper('clearsale_total/base')->getConfig(self::CODE_BASE_ADDRESS_MAP_STEET);
    }

    public function getNumberMap()
    {
        return Mage::helper('clearsale_total/base')->getConfig(self::CODE_BASE_ADDRESS_MAP_NUMBER);
    }

    public function getComplementMap()
    {
        return Mage::helper('clearsale_total/base')->getConfig(self::CODE_BASE_ADDRESS_MAP_COMPLEMENT);
    }

    public function getNeighborhoodMap()
    {
        return Mage::helper('clearsale_total/base')->getConfig(self::CODE_BASE_ADDRESS_MAP_NEIGHBORHOOD);
    }
}
