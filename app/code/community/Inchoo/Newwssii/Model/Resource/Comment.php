<?php

class Inchoo_Newwssii_Model_Resource_Comment extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        /* resource points on element in config.xml where table is defined! */
        $this->_init('inchoo_newwssii/news_comments', 'comment_id');
    }

}