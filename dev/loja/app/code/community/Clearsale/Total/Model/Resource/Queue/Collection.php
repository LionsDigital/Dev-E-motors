<?php

class Clearsale_Total_Model_Resource_Queue_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    const CUR_PAGE = 1;
    const STATUS_NEW = 'new';
    const CODE_COLUMN_STATUS = 'status';

    protected function _construct()
    {
        $this->setCurPage(self::CUR_PAGE);
        $this->setPageSize(Mage::helper('clearsale_total')->getNumberOrdersToProcessQueue());
        $this->setOrder('entity_id', self::SORT_ORDER_DESC);
        $this->_init('clearsale_total/queue');
    }

    public function process()
    {
        // get only orders with status new on queue
        $this->addFieldToFilter(self::CODE_COLUMN_STATUS, self::STATUS_NEW);

        foreach ($this->getItems() as $queue) {
            $queue->process();
        }

        $this->save();
    }
}
