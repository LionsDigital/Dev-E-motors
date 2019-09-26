<?php

class Clearsale_Total_Model_Api_Response_Validate
{
    private $order;

    public function __construct($response)
    {
        $this->validate($response);
        $this->setOrder($response);
    }

    public function getOrder()
    {
        return $this->order;
    }

    private function setOrder($response)
    {

        if (!empty($response->code)) {
            Mage::helper('clearsale_total/log')->response('Response: ');
            Mage::helper('clearsale_total/log')->response($response);
            $this->order = new Clearsale_Total_Model_Api_Response_Order(
                $response->code,
                $response->status,
                $response->score
            );
        }
    }

    private function validate($response)
    {
        if (isset($response->Message)) {
            Mage::helper('clearsale_total/log')->error('Errors: ');
            Mage::helper('clearsale_total/log')->error($response);

            throw new Exception('Clearsale: Something went wrong...');
        }
    }
}
