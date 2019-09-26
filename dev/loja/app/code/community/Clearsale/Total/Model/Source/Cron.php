<?php
class Clearsale_Total_Model_Source_Cron extends Mage_Core_Model_Config_Data
{
    const CRON_STRING_PATH = 'crontab/jobs/clearsale_total_sendorders/schedule/cron_expr';

    protected function _afterSave()
    {

        $frequency = $this->getValue();

        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_STRING_PATH, 'path')
                ->setValue($frequency)
                ->setPath(self::CRON_STRING_PATH)
                ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')->__('Unable to save the cron expression.'));
        }
    }
}
