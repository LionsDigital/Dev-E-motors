<?php
class Clearsale_Total_Block_Adminhtml_Sales_Order_View_Tab_Clearsale
    extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('clearsale_total');
        $this->setUseAjax(true);
        $this->setDefaultSort('updated_at');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('clearsale_total/history_collection');
        $collection->addOrderIdFilter($this->getOrder()->getId());
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('clearsale_total')->__('ID'),
            'index'     => 'entity_id',
            'width'     => '120px',
        ));

        $this->addColumn('status_code', array(
            'header' => Mage::helper('clearsale_total')->__('Status Code'),
            'index' => 'status_code',
            'type'      => 'options',
            'options' => Mage::helper('clearsale_total')->getStatusList()
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('clearsale_total')->__('First transaction date'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('clearsale_total')->__('Last communication'),
            'index'     => 'updated_at',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

    public function getTabLabel()
    {
        return $this->helper('clearsale_total')->__('ClearSale history');
    }

    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    public function canShowTab()
    {
        if ($this->helper('clearsale_total')->isEnabled()) {
            return $this->helper('clearsale_total')->isPaymentMethodAccepted($this->getOrder()->getPayment());
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

    public function getGridUrl()
    {
        return $this->getUrl('*/history/history', array('_current' => true));
    }
}
