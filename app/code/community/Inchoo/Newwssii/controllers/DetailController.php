<?php

class Inchoo_Newwssii_DetailController extends Mage_Core_Controller_Front_Action
{

    public function viewAction()
    {
        $id = $this->getRequest()->getParam('id', false);

        if(!$id) {
            $this->_forward('noRoute');
            return;
        }

        $news = Mage::getModel('inchoo_newwssii/news')->load($id);

        if(!$news->getId()) {
            $this->_forward('noRoute');
            return;
        }

        Mage::register('current_news', $news);

        $this->loadLayout();

        $this->renderLayout();

    }

    public function commentPostAction()
    {
        $id = $this->getRequest()->getParam('id', false);

        $comments_enabled = Mage::helper('inchoo_newwssii')->getCommentsEnabled();
        if($comments_enabled === '0') {
            Mage::log("Somebody is trying to be funny", null, 'commentspost.log', true);
        }

        if(!Mage::helper('inchoo_newwssii')->isLoggedIn()) {

            $this->_redirect('customer/account/login/');

        } else {
            if (isset($id)) {
                $customer_id = Mage::helper('inchoo_newwssii')->getCustomerId();

                $comment = Mage::getModel('inchoo_newwssii/comment');

                $comment->setData('comment', $this->getRequest()->getParam('comment'));
                $comment->setData('news_id', $id);
                $comment->setData('author_id', $customer_id);

                try {
                    $comment->save();
                } catch (Exception $e) {
                    Mage::logException($e);
                    $this->_redirect('news/index/showall/');
                }
            }
            $this->_redirect('news/detail/view/', array('id' => $id));
        }
    }
}