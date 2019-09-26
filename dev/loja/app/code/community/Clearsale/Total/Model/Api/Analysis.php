<?php

class Clearsale_Total_Model_Api_Analysis
{
    const APROVADO             = 'approved';
    const AGUARDANDO_APROVACAO = 'waiting_approval';
    const REPROVADO            = 'reproved';
    const ERRO                 = 'error';

    private $environment;
    private $service;
    private $clearSalePaymentIntegration;

    public function __construct(Clearsale_Total_Model_Api_Environment_AbstractEnvironment $environment)
    {
        $this->environment = $environment;
        $this->service = new Clearsale_Total_Model_Api_Service($environment);
    }

    public function analysis(Clearsale_Total_Model_Api_Request_Order $order)
    {
        $response = $this->service->sendOrders($order);
        return $this->statusClearsale($response);
    }

    public function chargeback($postData)
    {
        return $this->service->markChargeback($postData);
    }

    public function updateStatus($postData, $orderIncrementId)
    {
        return $this->service->updateClearsaleStatus($postData, $orderIncrementId);
    }

    public function getOrderStatus($orderId)
    {
        $response = $this->service->getOrderStatus($orderId);
        return $this->statusClearsale($response);
    }

    private function statusClearsale($response)
    {
        if ($response->getOrder()) {
            \Mage::dispatchEvent('clearsale_communication', ['response' => $response, 'order_id' => $response->getOrder()->getCode()]);

            if ($this->approved($response)) {
                return self::APROVADO;
            }

            if ($this->notApproved($response)) {
                return self::REPROVADO;
            }

            if ($this->waitingForApproval($response)) {
                return self::AGUARDANDO_APROVACAO;
            }

            return self::ERRO;
        }
    }

    private function approved($response)
    {
        switch ($response->getOrder()->getStatus()) {
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_APROVACAO_AUTOMATICA:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_APROVACAO_MANUAL:
                return true;
            default:
                return false;
        }
    }

    private function notApproved($response)
    {
        switch ($response->getOrder()->getStatus()) {
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_REPROVADA_SEM_SUSPEITA:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_SUSPENSAO_MANUAL:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_CANCELADO_PELO_CLIENTE:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_FRAUDE_CONFIRMADA:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_REPROVACAO_AUTOMATICA:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_REPROVACAO_POR_POLITICA:
                return true;
            default:
                return false;
        }
    }

    private function waitingForApproval($response)
    {
        switch ($response->getOrder()->getStatus()) {
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_ANALISE_MANUAL:
            case Clearsale_Total_Model_Api_Response_Order::STATUS_SAIDA_NOVO:
                return true;
            default:
                return false;
        }
    }
}
