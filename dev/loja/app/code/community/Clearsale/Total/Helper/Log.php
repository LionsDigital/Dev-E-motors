<?php

class Clearsale_Total_Helper_Log extends Clearsale_Total_Helper_Data
{
    const FILENAME_REQUEST = 'clearsale_total_request.log';
    const FILENAME_RESPONSE = 'clearsale_total_response.log';
    const FILENAME_ERROR = 'clearsale_total_error.log';
    const FILENAME_NOTIFICATION = 'clearsale_total_notification.log';

    /**
     * Check if log is enabled
     * @return boolean
     */
    public function isEnabledLog()
    {
        return Mage::helper('clearsale_total/base')->isEnabledLog();
    }

    /**
     * Log request information
     * @return boolean
     */
    public function request($message = '')
    {

        if ($this->isEnabledLog()) {
            return Mage::log($message, null, self::FILENAME_REQUEST, true);
        }

        return;
    }

    /**
     * Log response information
     * @return boolean
     */
    public function response($message = '')
    {

        if ($this->isEnabledLog()) {
            return Mage::log($message, null, self::FILENAME_RESPONSE, true);
        }

        return;
    }

    /**
     * Log error information
     * @return boolean
     */
    public function error($message = '')
    {

        if ($this->isEnabledLog()) {
            return Mage::log($message, null, self::FILENAME_ERROR, true);
        }

        return;
    }

    /**
     * Log notification information
     * @return boolean
     */
    public function notification($message = '')
    {

        if ($this->isEnabledLog()) {
            return Mage::log($message, null, self::FILENAME_NOTIFICATION, true);
        }

        return;
    }
}
