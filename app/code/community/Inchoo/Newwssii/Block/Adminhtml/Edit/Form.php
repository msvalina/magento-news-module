<?php

class Inchoo_Newwssii_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('news_form');
        $this->setTitle(Mage::helper('inchoo_newwssii')->__('News Information'));
    }

    public function getModel()
    {
        return Mage::registry('current_news');
    }

    public function getComments()
    {
        return Mage::registry('current_comments');
    }

    protected function _prepareForm()
    {
        $model  = $this->getModel();
        $comments = $this->getComments();


        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/news/save'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('inchoo_newwssii')->__('News Information'),
            'class'     => 'fieldset-wide'
        ));

        $fieldset->addField('news_id', 'hidden', array(
            'name'          => 'id',
            'container_id'  => 'news_id',
            'value'         => $model->getId(),
        ));

        $fieldset->addField('news', 'editor', array(
            'name'          => 'news',
            'label'         => Mage::helper('inchoo_newwssii')->__('News'),
            'container_id'  => 'news',
            'value'         => $model->getNews()
        ));

        $fieldset->addField('is_published', 'select', array(
            'name'          => 'is_published',
            'label'         => Mage::helper('inchoo_newwssii')->__('Status'),
            'title'         => Mage::helper('inchoo_newwssii')->__('Status'),
            'container_id'  => 'is_published',
            'required'      => true,
            'options'   => array(
                '1' => Mage::helper('inchoo_newwssii')->__('Published'),
                '0' => Mage::helper('inchoo_newwssii')->__('Unpublished'),
            ),
        ));


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        /* Comments with custom template */
        $comments_block = $this->getLayout()->createBlock('inchoo_newwssii/adminhtml_edit_form_comments')
            ->setTemplate('inchoo_newwssii/comments.phtml');

        $this->setChild('form_after', $comments_block);

        /* or with new form without setForm

        $form2   = new Varien_Data_Form(array(
            'id'        => 'dummy',
            //'action'    => '',
            'class' => 'entry-edit'
        ));

        $form2->setUseContainer(true);

        $additional_fieldset   = $form2->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('inchoo_newwssii')->__('Comments'),
            'class'     => 'fieldset-wide'
        ));

        if(!$comments->count()) {
            $additional_fieldset->addField('nocomments', 'label', array(
                'name'          => 'nocomments',
                'label'         => Mage::helper('inchoo_newwssii')->__('No comments'),
                'container_id'  => 'nocomments',
            ));
        }
        else {
            foreach ($comments as $_comment) {
                $_id = $_comment->getId();
                $additional_fieldset->addField('comment' . $_id, 'label', array(
                    'name'          => 'comment' . $_id,
                    'label'         => Mage::helper('inchoo_newwssii')->__('Comment: ' . $_id),
                    'container_id'  => 'comment',
                    'value'         => $_comment->getComment(),
                    //'bold'          => true
                ));
            }
        }

        //$this->setChild('form_after', $form2);
        */

        return parent::_prepareForm();
    }
}
