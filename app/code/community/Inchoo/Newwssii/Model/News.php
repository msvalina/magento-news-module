<?php

class Inchoo_Newwssii_Model_News extends Mage_Core_Model_Abstract

{

    protected function _construct()
    {
        $this->_init('inchoo_newwssii/news');
        Mage::log("lets log something", null, 'news.log', true);
    }


    public function getNewsComments()
    {
        return $this->getResource()->getNewsComments($this->getId());

    }


}