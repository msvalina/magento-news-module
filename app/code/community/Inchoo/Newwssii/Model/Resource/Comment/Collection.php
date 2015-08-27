<?php

class Inchoo_Newwssii_Model_Resource_Comment_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('inchoo_newwssii/comment');
    }

}