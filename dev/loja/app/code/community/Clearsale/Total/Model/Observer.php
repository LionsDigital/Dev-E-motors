<?php

class Clearsale_Total_Model_Observer
{
    const STATUS_NEW = 'new';

    public function enqueueOrder(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('clearsale_total')->isEnabled()) {
            return;
        }

        $order = $observer->getEvent()->getOrder();
        $order->setCsSessionId(Mage::getSingleton("core/session")->getEncryptedSessionId());

        if (!Mage::helper('clearsale_total')->isPaymentMethodAccepted($order->getPayment())) {
            return;
        }

//        if (!is_numeric($order->getIncrementId()) && !Mage::helper('clearsale_total')->getConfig('endorderedited')) {
//            return;
//        }

        $queue = Mage::getModel('clearsale_total/queue');
        $queue->setOrderId($order->getId());
        $queue->setStatus(self::STATUS_NEW);
        $queue->save();
    }

    public function saveCommunicationHistory(Varien_Event_Observer $observer)
    {
        $response = $observer->getEvent()->getResponse();
        if (!$response || !$response->getOrder()) {
            return;
        }

        $order = Mage::getModel('sales/order')->loadByIncrementId($response->getOrder()->getCode());
        $history = Mage::getModel('clearsale_total/history')->getCollection()->addOrderIdFilter($order->getCode());

        if (count($history)) {
            if ($history->getLastItem()->getStatusCode() == $response->getOrder()->getStatus()) {
                $history->getLastItem()->setUpdatedAt(date('Y-m-d H:i:s'));
                return $history->save();
            }
        }

        $data = [
            'order_id' => $order->getId(),
            'status_code' => $response->getOrder()->getStatus(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Mage::getModel('clearsale_total/history')->setData($data)->save();
    }

    public function beforeBlockToHtml(Varien_Event_Observer $observer)
    {
        $grid = $observer->getBlock();

        if ($grid instanceof Mage_Adminhtml_Block_Sales_Order_Grid) {
            $grid->addColumnAfter(
                'cs_status',
                [
                    'header' => 'Status ClearSale',
                    'type'   => 'options',
                    'width' => '80px',
                    'align' => 'center',
                    'options' => $this->getClearSaleStatuses(),
                    'index' => 'cs_status',
                    'filter_index' => 'main_table.cs_status',
                ],
                'status'
            );
        }
    }

    private function getClearSaleStatuses()
    {
        return [
            Clearsale_Total_Model_Api_Analysis::AGUARDANDO_APROVACAO => 'Aguardando aprovação',
            Clearsale_Total_Model_Api_Analysis::APROVADO => 'Aprovado',
            Clearsale_Total_Model_Api_Analysis::REPROVADO => 'Reprovado',
            Clearsale_Total_Model_Api_Analysis::ERRO => 'Erro',
        ];
    }
}
