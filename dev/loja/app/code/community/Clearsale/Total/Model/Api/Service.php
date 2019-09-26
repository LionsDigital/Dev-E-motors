<?php

class Clearsale_Total_Model_Api_Service extends Clearsale_Total_Model_Api_Integration
{
    /**
     * Get order status
     * @param  string $orderId
     * @return Clearsale_Total_Model_Api_Response_Validate
     */
    public function getOrderStatus($orderId)
    {
        $options = [
            'uri' => $this->getOrderStatusUrl($orderId),
            'header' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->environment->getAccessToken()
            ],
            'method' => 'GET'
        ];

        $this->logger->request('OrderStatus - Request options:');
        $this->logger->request($options);

        return new Clearsale_Total_Model_Api_Response_Validate($this->connector->doRequest([], $options));
    }

    /**
     * Send orders
     *
     * @param Clearsale_Total_Model_Order $order
     * @return Clearsale_Total_Model_Api_Response_Validate
     */
    public function sendOrders(Clearsale_Total_Model_Order $order)
    {
        $options = [
            'uri' => $this->getSendOrdersUrl(),
            'header' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->environment->getAccessToken()
            ],
            'method' => 'POST'
        ];

        $this->logger->request('SendOrders - Request options:');
        $this->logger->request($options);

        $this->logger->request('SendOrders - JSON:');
        $this->logger->request($order->toJSON());

        $response = $this->connector->doRequest($order->toJSON(), $options);

        return new Clearsale_Total_Model_Api_Response_Validate(end($response->orders));
    }

    public function markChargeback($postData)
    {
        $options = [
            'uri' => $this->getMarkChargebackUrl(),
            'header' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->environment->getAccessToken()
            ],
            'method' => 'POST'
        ];

        $this->logger->request('SendOrders - Request options:');
        $this->logger->request($options);

        $this->logger->request('SendOrders - JSON:');
        $this->logger->request(json_encode($postData));

        return $this->connector->doRequest(json_encode($postData), $options);
    }

    public function updateClearsaleStatus($postData, $orderIncrementId)
    {
        $options = [
            'uri' => $this->getUpdateStatusUrl($orderIncrementId),
            'header' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->environment->getAccessToken()
            ],
            'method' => 'PUT'
        ];

        $this->logger->request('SendOrders - Request options:');
        $this->logger->request($options);

        $this->logger->request('SendOrders - JSON:');
        $this->logger->request(json_encode($postData));

        return $this->connector->doRequest(json_encode($postData), $options);

    }
}
