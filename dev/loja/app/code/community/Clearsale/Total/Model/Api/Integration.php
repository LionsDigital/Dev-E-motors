<?php

abstract class Clearsale_Total_Model_Api_Integration
{
    const URI_ORDER = 'v1/orders/';
    const URI_ORDER_STATUS = '/status';
    const URI_CHARGEBACK = 'v1/chargeback';

    protected $environment;
    protected $connector;
    protected $logger;

    public function __construct(Clearsale_Total_Model_Api_Environment_AbstractEnvironment $environment)
    {
        $this->environment = $environment;
        $this->connector   = new Clearsale_Total_Model_Api_Connector($environment);
        $this->logger = Mage::helper('clearsale_total/log');
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    protected function getSendOrdersUrl()
    {
        return $this->environment->getApiUrl().self::URI_ORDER;
    }

    protected function getMarkChargebackUrl()
    {
        return $this->environment->getApiUrl().self::URI_CHARGEBACK;
    }

    protected function getOrderStatusUrl($orderId)
    {
        return $this->environment->getApiUrl().self::URI_ORDER.$orderId.self::URI_ORDER_STATUS;
    }

    protected function getUpdateStatusUrl($orderId)
    {
        return $this->environment->getApiUrl().self::URI_ORDER.$orderId.self::URI_ORDER_STATUS;
    }
}
