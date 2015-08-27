<?php

class Inchoo_Newwssii_Model_Resource_News extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('inchoo_newwssii/news', 'news_id');
    }


    public function getNewsComments($newsId)
    {
        $collection = Mage::getResourceModel('inchoo_newwssii/comment_collection')
            ->addFieldToFilter('news_id', $newsId);

        return $collection;
    }

}