<?php

class Inchoo_Newwssii_Block_Adminhtml_Edit_Form_Comments extends Mage_Adminhtml_Block_Template
{
    public function getComments()
    {
        $news = Mage::registry('current_news');

        $comments = Mage::getResourceModel('inchoo_newwssii/comment_collection')
            ->addFieldToFilter('news_id', $news->getId());

        return $comments;
    }
}