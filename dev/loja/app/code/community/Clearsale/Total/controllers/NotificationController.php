<?php

class Clearsale_Total_NotificationController extends Mage_Core_Controller_Front_Action
{
    const NOTIFICATION_STATUS_TYPE = 'status';
    const STATUS_CODE_UNAVAILABLE = 503;
    const STATUS_CODE_SUCCESS = 200;

    public function indexAction()
    {
        try {
            $postData = json_decode(utf8_encode(file_get_contents('php://input')));

            Mage::helper('clearsale_total/log')->notification('Request: ');
            Mage::helper('clearsale_total/log')->notification($postData);

            // Get updated status and update him
            if ($postData->type == self::NOTIFICATION_STATUS_TYPE) {
                $response = Mage::helper('clearsale_total')->getClearSale()->getOrderStatus($postData->code);
                $responseProcess = Mage::getModel('clearsale_total/response')->process($response, $postData->code);

                if ($responseProcess) {
                    return $this->getResponse()
                        ->clearHeaders()
                        ->setHeader('HTTP/1.0', self::STATUS_CODE_SUCCESS, true)
                        ->setHeader('Content-Type', 'text/html');
                }
            }
        } catch (Exception $e) {
            Mage::helper('clearsale_total/log')->notification('Response with error: ');
            Mage::helper('clearsale_total/log')->notification($e->getMessage());

            return $this->getResponse()
                ->clearHeaders()
                ->setHeader('HTTP/1.0', self::STATUS_CODE_UNAVAILABLE, true)
                ->setHeader('Content-Type', 'text/html');
        }
    }
}
