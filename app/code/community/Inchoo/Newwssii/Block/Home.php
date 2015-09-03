<?php

class Inchoo_Newwssii_Block_Home extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLatestNews($count = 3)
    {
        $collection = Mage::getModel('inchoo_newwssii/news')->getCollection();
        $collection->setOrder('news_id', 'DESC');
        $collection->getSelect()->limit($count);

        return $collection;
    }

}