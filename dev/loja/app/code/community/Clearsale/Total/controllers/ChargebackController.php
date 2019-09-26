<?php
include_once('Mage/Adminhtml/controllers/Sales/OrderController.php');
class Clearsale_Total_ChargebackController extends Mage_Adminhtml_Controller_Action
{
    protected $helper;
    private $order;
    const CHARGEBACK_DONE_STATUS = 'Chargeback done';

    protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);

        if (!$order->getId()) {
            $this->_getSession()->addError($this->__('This order no longer exists.'));
            $this->_redirect('*/*/');
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        return $order;
    }

    public function chargebackAction()
    {
        $this->order = $this->_initOrder();
        $data = $this->getRequest()->getPost();
        $postData = [
            'message' => $data['chargeback']['message'],
            'orders' => [$this->order->getIncrementId()]
        ];

        try {
            $responseData = Mage::helper('clearsale_total')->getClearSale()->chargeback($postData);
            if ($responseData[0]->status != self::CHARGEBACK_DONE_STATUS) {
                return $this->chargebackInvalid();
            }
            return $this->chargebackDone();
        } catch (Exception $e) {
            $response = array(
                'error' => true,
                'message' => $e->getMessage(),
            );
            $this->showMessage($response);
        }
    }

    public function chargebackDone()
    {
        $response = array(
            'error'     => true,
            'message'   => $this->__('Chargeback marking completed.'),
        );
        $this->order->addStatusHistoryComment($response['message']);
        $this->order->save();
        $this->showMessage($response);
    }

    public function chargebackInvalid()
    {
        $response = array(
            'error'     => true,
            'message'   => $this->__('Chargeback could not be mark.')
        );
        $this->showMessage($response);
    }

    private function showMessage($response)
    {
        $response = Mage::helper('core')->jsonEncode($response);
        $this->getResponse()->setBody($response);
    }
}
