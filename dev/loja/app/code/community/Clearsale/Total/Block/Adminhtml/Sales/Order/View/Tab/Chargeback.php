<?php
class Clearsale_Total_Block_Adminhtml_Sales_Order_View_Tab_Chargeback extends Mage_Adminhtml_Block_Widget_Grid implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('clearsale_chargeback');
        $this->setTemplate('clearsale/chargeback.phtml');
        $this->setUseAjax(true);
    }

    protected function _prepareLayout()
    {
        $onclick = "submitAndReloadArea($('order_history_blocks').parentNode, '".$this->getSubmitUrl()."')";
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'   => Mage::helper('clearsale_total')->__('Request Chargeback'),
                'class'   => 'save',
                'onclick' => $onclick
            ));
        $this->setChild('submit_button', $button);
        return parent::_prepareLayout();
    }

    public function getTabLabel()
    {
        return $this->helper('clearsale_total')->__('Clearsale - Chargeback');
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

    public function getSubmitUrl()
    {
        return $this->getUrl('*/chargeback/chargeback', array('order_id'=>$this->getOrder()->getId()));
    }
}
