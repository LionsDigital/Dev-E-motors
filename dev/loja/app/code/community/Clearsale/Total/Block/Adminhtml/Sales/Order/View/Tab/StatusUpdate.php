<?php
class Clearsale_Total_Block_Adminhtml_Sales_Order_View_Tab_StatusUpdate
    extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('clearsale_statusupdate');
        $this->setTemplate('clearsale/statusupdate.phtml');
        $this->setUseAjax(true);
    }

    protected function _prepareLayout()
    {
        $onclick = "submitAndReloadArea($('total_status_update_block').parentNode, '".$this->getSubmitUrl()."')";
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'   => Mage::helper('clearsale_total')->__('Request status update'),
                'class'   => 'save',
                'onclick' => $onclick
            ));
        $this->setChild('submit_button', $button);
        return parent::_prepareLayout();
    }

    public function getTabLabel()
    {
        return $this->helper('clearsale_total')->__('Clearsale - Status Update');
    }

    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    public function canShowTab()
    {
        if ($this->helper('clearsale_total')->isEnabled()) {
            return true;
        }

        return false;
    }

    public function isHidden()
    {
        return !$this->getOrder()->hasData('cs_status');
    }

    /** @return Mage_Sales_Model_Order */
    private function getOrder()
    {
        return Mage::registry('current_order');
    }

    public function getPaymentStatusOption()
    {
        return [
            'PGR' => __('Disapproved Payment'),
            'PGA' => __('Approved Payment')
        ];
    }

    public function getSubmitUrl()
    {
        return $this->getUrl('*/statusUpdate/statusUpdateTotal', array('order_id'=>$this->getOrder()->getId()));
    }
}
