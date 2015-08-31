<?php

class Inchoo_Newwssii_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();
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
            'action'    => $this->getData('action'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('inchoo_newwssii')->__('News Information'),
            'class'     => 'fieldset-wide'
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name'      => 'id',
                'value'     => $model->getId(),
            ));
        }

        $fieldset->addField('news', 'editor', array(
            'name'          =>'styles',
            'label'         => Mage::helper('inchoo_newwssii')->__('News'),
            'container_id'  => 'news',
            'value'         => $model->getNews()
        ));

        $form->setAction($this->getUrl('*/*/save'));
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
