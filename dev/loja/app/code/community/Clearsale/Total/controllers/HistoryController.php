<?php
include_once('Mage/Adminhtml/controllers/Sales/OrderController.php');

class Clearsale_Total_HistoryController extends Mage_Adminhtml_Sales_OrderController
{
    public function historyAction()
    {
        $this->_initOrder();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('clearsale_total/adminhtml_sales_order_view_tab_clearsale')->toHtml()
        );
    }
}
