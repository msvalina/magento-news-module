<?php

class Inchoo_Newwssii_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

        $this->_blockGroup = 'inchoo_newwssii';

        $this->_controller = 'adminhtml_news';

        $this->_headerText = Mage::helper('inchoo_newwssii')->__('News admin page');
        $this->_addButtonLabel = Mage::helper('inchoo_newwssii')->__('Add News');

        parent::__construct();

    }

}