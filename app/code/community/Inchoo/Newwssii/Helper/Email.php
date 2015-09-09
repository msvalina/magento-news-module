<?php

class Inchoo_Newwssii_Helper_Email extends Mage_Core_Helper_Data
{
    const XML_PATH_EMAIL_ADMIN_ON_COMMENT_ENABLED = 'inchoo_newwssii/email_settings/email_on_new_comment_enabled';
    const XML_PATH_EMAIL_TEMPLATE = 'inchoo_newwssii/email_settings/email_template';

    public function getEmailAdminOnComment($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_ADMIN_ON_COMMENT_ENABLED, $store);
    }

    public function getEmailTemplate($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE, $store);
    }

}