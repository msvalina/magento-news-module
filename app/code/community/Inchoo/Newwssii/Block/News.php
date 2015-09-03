<?php

class Inchoo_Newwssii_Block_News extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('inchoo_newwssii/show_all.phtml');
    }

    public function getAllNews()
    {
        return Mage::registry('all_news');
    }

}