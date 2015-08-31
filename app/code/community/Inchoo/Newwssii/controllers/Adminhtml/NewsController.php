<?php

class Inchoo_Newwssii_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();

        $this->loadLayout()->_setActiveMenu('news/inchoo_newwssii');

        $this->_addContent($this->getLayout()->createBlock('inchoo_newwssii/adminhtml_news'));
        $this->renderLayout();

    }

    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()
            ->createBlock('inchoo_newwssii/adminhtml_news_grid')->toHtml());

    }

    public function newAction()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Inchoo News'))
            ->_title($this->__('News'))
            ->_title($this->__('Manage Content'));

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('inchoo_newwssii/news');

        Mage::register('current_news', $model);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('inchoo_newwssii')->__('This news no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('News Page'));

        $this->loadLayout()->_setActiveMenu('news/inchoo_newwssii');

        $this->_addContent($this->getLayout()->createBlock('inchoo_newwssii/adminhtml_edit'));

        $this->renderLayout();

    }

    public function saveAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->getResponse()->setRedirect($this->getUrl('*/news'));
        }

        $news = Mage::getModel('inchoo_newwssii/news');

        if ($id = (int) $request->getParam('id')) {
            $news->load($id);
        }
        try {
            //getParams and save

        }
        catch (Mage_Core_Exception $e) {

        }
    }

}