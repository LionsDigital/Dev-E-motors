<?php

abstract class Clearsale_Total_Model_Api_Environment_AbstractEnvironment
{
    const URI_AUTH = 'v1/authenticate';

    protected $login;
    protected $password;
    protected $apiUrl;
    protected $debug = false;
    private $accessToken;
    private $expirationDate;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->generateAccessToken();
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        return $this->accessToken = $accessToken;
    }

    public function setExpirationDate($expirationDate)
    {
        return $this->expirationDate = $expirationDate;
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    private function credentials()
    {
        return json_encode([
            'name' => $this->getLogin(),
            'password' => $this->getPassword()
        ]);
    }

    private function generateAccessToken()
    {
        Mage::app()->getConfig()->reinit(); // Clear cache from core config data
        
        $dateExpiration = '';
        
       if (Mage::helper('clearsale_total')->getConfig('expirationDate')) {
            $dateExpiration = new DateTime(Mage::helper('clearsale_total')->getConfig('expirationDate'));
        }
        
        $today = time();

        if (empty($dateExpiration) || $today > $dateExpiration->getTimestamp()) {
            $client = new Zend_Http_Client($this->apiUrl.self::URI_AUTH);

            $client->setHeaders(['Content-Type' => 'application/json']);
            $client->setConfig(['timeout'=> 30]);
            $client->setRawData($this->credentials(), 'application/json');
            $client->request('POST');

            $response = json_decode($client->getLastResponse()->getBody());
            $this->setAccessToken($response->Token);
            $this->setExpirationDate($response->ExpirationDate);
            $this->saveToken($response->Token, $response->ExpirationDate);
            return;
        }

        $this->setAccessToken(Mage::helper('clearsale_total')->getConfig('accessToken'));
        $this->setExpirationDate(Mage::helper('clearsale_total')->getConfig('expirationDate'));
    }

    private function saveToken($token, $expirationDate)
    {
        if (!empty($token) && !empty($expirationDate)) {
            Mage::getConfig()->saveConfig('clearsale_setting_total/clearsale_settings_total/accessToken', $token, 'default', 0);
            Mage::getConfig()->saveConfig('clearsale_setting_total/clearsale_settings_total/expirationDate', $expirationDate, 'default', 0);
        }
    }
}
