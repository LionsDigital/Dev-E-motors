<?php

class Clearsale_Total_Model_Resource_Queue extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('clearsale_total/queue', 'entity_id');
    }
}
