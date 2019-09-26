<?php

class Clearsale_Total_Model_Api_Request_SocialNetwork implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $optInCompreConfie;
    private $typeSocialNetwork;
    private $authenticationToken;

    /**
     *
     * @return string
     */
    public function getOptInCompreConfie()
    {
        return $this->optInCompreConfie;
    }

    public function setOptInCompreConfie($optInCompreConfie)
    {
        return $this->optInCompreConfie = $optInCompreConfie;
    }

    /**
     *
     * @return string
     */
    public function getTypeSocialNetwork()
    {
        return $this->typeSocialNetwork;
    }

    public function setTypeSocialNetwork($typeSocialNetwork)
    {
        return $this->typeSocialNetwork = $typeSocialNetwork;
    }

    /**
     *
     * @return string
     */
    public function getAuthenticationToken()
    {
        return $this->authenticationToken;
    }

    public function setAuthenticationToken($authenticationToken)
    {
        return $this->authenticationToken = $authenticationToken;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
