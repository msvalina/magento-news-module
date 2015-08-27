<?php

class Inchoo_Newwssii_Block_Detail extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('inchoo_newwssii/detail_view.phtml');

    }

    public function getNews()
    {
        return Mage::registry('current_news');

    }

    public function getCollection()
    {

        $news = $this->getNews();

        if($news->getId()) {
            $comments = $news->getNewsComments();
            //var_dump($news->getData());
            //var_dump($comments));
        }

        return $comments;
    }

}