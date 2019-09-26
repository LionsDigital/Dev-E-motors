<?php

class Clearsale_Profiler_Model_Api
{

    public function __construct()
    {
        $environment = Mage::getStoreConfig('clearsale_setting_base/clearsale_settings/environment');

        if($environment == "staging") {
            $this->userName = Mage::getStoreConfig('clearsale_setting_base/clearsale_settings/staging_api_key');
            $this->password = Mage::getStoreConfig('clearsale_setting_base/clearsale_settings/staging_api_password');
            $this->apiUrl = "https://homologacao.clearsale.com.br/api/v1/";
        }else{
            $this->userName = Mage::getStoreConfig('clearsale_setting_base/clearsale_settings/production_api_key');
            $this->password = Mage::getStoreConfig('clearsale_setting_base/clearsale_settings/production_api_password');
            $this->apiUrl = "https://api.clearsale.com.br/v1/";
        }
    }

    private function loginOnApi()
    {
        $data = $this->post(
            [
                'name' => $this->userName,
                'password' => $this->password
            ],
            "/authenticate"
        );

        return $data ? $data['Token'] : false;
    }

    public function accountCreate($data)
    {
        $data = $this->callApi($data, "/accounts");
        if (!isset($data['account']['code'])) {
            return false;
        }
        return $data['account']['code'];
    }

    public function callApi($data, $url, $method = "POST")
    {
        $token = $this->loginOnApi();
        if (!$token) {
            return;
        }

        return $this->post($data, $url, $token);
    }

    public function post($data, $url, $token = false, $method = "POST")
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($token) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        if ($method != "POST") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        $result = curl_exec($ch);
        $httpResponseCode = (string)curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (strpos($httpResponseCode, "20") === false || strpos($httpResponseCode, "30") === false) {
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result = substr($result, $header_size);

            curl_close($ch);

            return json_decode($result, true);
        } else {
            curl_close($ch);

            Mage::log("Error when tring to call route " . $this->apiUrl . $url . " Return: " . $result);
            return false;
        }
    }

    public function login($data)
    {
        $this->callApi($data, "Accounts/Login");
    }

    public function logout($data)
    {
        $this->callApi($data, "Accounts/Logout");
    }

    public function accountUpdate($data)
    {
        $this->callApi($data, "/accounts", "PUT");
    }

    public function passwordReset($data)
    {
        $this->callApi($data, "Accounts/ResetPassword");
    }
}