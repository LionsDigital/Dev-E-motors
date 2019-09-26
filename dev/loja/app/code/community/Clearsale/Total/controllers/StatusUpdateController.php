<?php
include_once('Mage/Adminhtml/controllers/Sales/OrderController.php');
class Clearsale_Total_StatusUpdateController extends Mage_Adminhtml_Controller_Action
{
    protected $helper;
    private $order;
    const UPDATESTATUS_DONE_STATUS = 'OK';

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

    public function statusUpdateTotalAction()
    {
        $this->order = $this->_initOrder();
        $postData = $this->getRequest()->getPost()['statusupdate'];

        try {
            $responseUpdateStatus = Mage::helper('clearsale_total')->getClearSale()->updateStatus($postData, $this->order->getIncrementId());
            if (!$responseUpdateStatus) {
                return $this->updateStatusInvalid();
            }
            if ($responseUpdateStatus->status == self::UPDATESTATUS_DONE_STATUS) {
                return $this->updateStatusDone();
            }
            return $this->updateStatusInvalid();
        } catch (Exception $e) {
            $response = array(
                'error' => true,
                'message' => $this->__('The order status could not be updated at Clearsale.')
            );
            $this->showMessage($response);
        }
    }

    public function updateStatusDone()
    {
        $response = array(
            'error' => true,
            'message' => $this->__('Order status at Clearsale has been updated.'),
        );
        $this->order->addStatusHistoryComment($response['message']);
        $this->order->save();
        $this->showMessage($response);
    }

    public function updateStatusInvalid()
    {
        $response = array(
            'error' => true,
            'message' => $this->__('The order status could not be updated at Clearsale.')
        );
        $this->showMessage($response);
    }

    private function showMessage($response)
    {
        $response = Mage::helper('core')->jsonEncode($response);
        $this->getResponse()->setBody($response);
    }
}
