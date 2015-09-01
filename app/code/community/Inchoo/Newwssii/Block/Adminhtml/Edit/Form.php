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

    protected function _prepareForm()
    {
        $model  = $this->getModel();

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

        $comments_block = $this->getLayout()->createBlock('inchoo_newwssii/adminhtml_edit_form_comments')
            ->setTemplate('inchoo_newwssii/comments.phtml');

        $this->setChild('form_after', $comments_block);

        return parent::_prepareForm();
    }



}
