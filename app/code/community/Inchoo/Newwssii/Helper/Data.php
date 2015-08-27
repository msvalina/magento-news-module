<?php

class Inchoo_Newwssii_Helper_Data extends Mage_Core_Helper_Data
{
    const XML_PATH_COMMENTS_ENABLED = 'inchoo_newwssii/settings/comments_enabled';

    public function getCommentsEnabled($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_COMMENTS_ENABLED, $store);
    }

    public function isLoggedIn()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    public function getCustomerId()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getId();
    }

    public function getCustomerName()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getName();
    }

}