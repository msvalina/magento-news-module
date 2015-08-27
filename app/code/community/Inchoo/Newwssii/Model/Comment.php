<?php

class Inchoo_Newwssii_Model_Comment extends Mage_Core_Model_Abstract

{
    protected function _construct()
    {
        $this->_init('inchoo_newwssii/comment');
        Mage::log("commeentt", null, 'news.log', true);
    }

}