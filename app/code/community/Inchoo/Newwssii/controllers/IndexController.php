<?php

class Inchoo_Newwssii_IndexController extends Mage_Core_Controller_Front_Action
{

    public function showAllAction()
    {
        $news_all = Mage::getModel('inchoo_newwssii/news')->getCollection()
            ->setOrder('news_id', 'DESC');

        Mage::register('all_news', $news_all);

        $this->loadLayout();

        $this->renderLayout();

    }

    public function addNewsAction()
    {
        $news = Mage::getModel('inchoo_newwssii/news');

        $news->setData('news', 'one more true news');
        $news->setData('author_id', 1);
        $news->setData('is_published', true);

        $news->save();
        var_dump($news);

    }

}