<?php

class Inchoo_Newwssii_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'inchoo_newwssii';
    protected $_controller = 'adminhtml';
    protected $_objectId = 'id';

    public function __construct()
    {
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('inchoo_newwssii')->__('Save News'));
        $this->_updateButton('delete', 'label', Mage::helper('inchoo_newwssii')->__('Delete News'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);



    }

    public function getHeaderText()
    {
        if (Mage::registry('current_news')->getId()) {
            return Mage::helper('inchoo_newwssii')->__("Edit News");
        }
        else {
            return Mage::helper('inchoo_newwssii')->__('New News');
        }
    }


}

