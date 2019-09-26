<?php
class Clearsale_Fingerprint_Block_Fingerprint extends Mage_Core_Block_Template
{
    const CONFIG_TAG_MANAGER = 'clearsale_fingerprint_settings/settings/config_google_tag_manager';
    const APP_NAME = 'clearsale_fingerprint_settings/settings/app_name';

    public function getGoogleTagManagerStatus()
    {
        return Mage::getStoreConfig(self::CONFIG_TAG_MANAGER, Mage::app()->getStore());
    }

    public function getSessionId()
    {
        return Mage::getSingleton("core/session")->getEncryptedSessionId();
    }

    public function getAppName()
    {
        return Mage::getStoreConfig(self::APP_NAME, Mage::app()->getStore());
    }
}