<?php

class Inchoo_Newwssii_Model_Resource_News extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('inchoo_newwssii/news', 'news_id');
    }

    public function getNewsComments($newsId)
    {
        $attribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'firstname');

        $collection = Mage::getResourceModel('inchoo_newwssii/comment_collection')
            ->addFieldToFilter('news_id', $newsId)
            ->setOrder('comment_id', 'DESC');

        $collection->getSelect()
            ->joinLeft(
                array('name_table' => $attribute->getBackendTable()),
                'main_table.author_id = name_table.entity_id AND name_table.attribute_id = ' . $attribute->getId(),
                array('value AS name')
            );

        //var_dump((string)$collection->getSelect()); die();

        return $collection;
    }

}