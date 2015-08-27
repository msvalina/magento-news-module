<?php

class Inchoo_Newwssii_Helper_Data extends Mage_Core_Helper_Data
{

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