<?php

class Clearsale_Total_Model_Cron
{
    public function processQueue()
    {
        Mage::getResourceModel('clearsale_total/queue_collection')->process();
    }
}
