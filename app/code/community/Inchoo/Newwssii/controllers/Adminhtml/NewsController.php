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

        $comments = Mage::getResourceModel('inchoo_newwssii/comment_collection')
            ->addFieldToFilter('news_id', $model->getId());
        Mage::register('current_comments', $comments);


        $this->_title($model->getId() ? $model->getTitle() : $this->__('News Page'));

        $this->loadLayout()->_setActiveMenu('news/inchoo_newwssii');

        $this->_addContent($this->getLayout()->createBlock('inchoo_newwssii/adminhtml_edit'));

        $this->renderLayout();

    }

    public function saveAction()
    {
        $request = $this->getRequest();
        Mage::log($request->getParams(), null, 'save.log', true);

        if (!$request->isPost()) {
            $this->getResponse()->setRedirect($this->getUrl('*/news'));
        }

        $id = (int) $request->getParam('id');
        $news = Mage::getModel('inchoo_newwssii/news')->load($id);

        $user = Mage::getSingleton('admin/session');

        try {
            if ($news->getId()) {
                Mage::log('updating', null, 'save.log', true);
                $news->load($id)
                    ->setData('news', $request->getParam('news'))
                    ->setData('news_id', $id)
                    ->setData('author_id', $user->getUser()->getId())
                    ->setData('is_published', $request->getParam('is_published'))
                    ->save();
            }
            else {
                // save new
                Mage::log('creating', null, 'save.log', true);
                $news->setData('news', $request->getParam('news'))
                    ->setData('author_id', $user->getUser()->getId())
                    ->setData('created_at', time())
                    ->setData('is_published', $request->getParam('is_published'))
                    ->save();
            }

            // go to grid
            $this->_redirect('*/*/');
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('inchoo_newwssii/news');
                $model->load($id);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('inchoo_newwssii')->__('The news has been deleted.'));
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inchoo_newwssii')->__('Unable to find a news to delete.'));
        // go to grid
        $this->_redirect('*/*/');

    }
}