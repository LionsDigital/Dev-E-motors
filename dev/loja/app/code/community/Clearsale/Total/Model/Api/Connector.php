<?php

class Clearsale_Total_Model_Api_Connector
{
    const DEFAULT_TIMEOUT = 30;

    private $environment;

    public function __construct(Clearsale_Total_Model_Api_Environment_AbstractEnvironment $environment)
    {
        $this->environment = $environment;
    }

    public function doRequest($data = [], $options)
    {
        if (!isset($options['uri']) && empty($options['uri'])) {
            throw new Exception('Clearsale: URI is empty!');
        }

        $client = new Zend_Http_Client($options['uri']);
        $client->setHeaders($options['header']);
        $client->setConfig(['timeout'=> isset($options['timeout']) ?  $options['timeout'] : self::DEFAULT_TIMEOUT]);

        if (!empty($data)) {
            $client->setRawData($data, 'application/json');
        }

        $client->request(isset($options['method']) ? $options['method'] : 'POST');

        return json_decode($client->getLastResponse()->getBody());
    }
}