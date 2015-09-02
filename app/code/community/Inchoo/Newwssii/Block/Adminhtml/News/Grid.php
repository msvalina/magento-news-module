<?php

class Inchoo_Newwssii_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('inchoo_newwssii');
        $this->setDefaultSort('news_id');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {

        $collection = Mage::getModel('inchoo_newwssii/news')->getCollection();

        $collection->getSelect()->joinLeft('admin_user', 'main_table.author_id = admin_user.user_id', array('username'));

        //var_dump((string)$collection->getSelect()); die();

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }


    protected function _prepareColumns()
    {

        $this->addColumn('news_id', array(
                'header' => Mage::helper('inchoo_newwssii')->__('ID'),
                'sortable' => true,
                'index' => 'news_id',
                //'filter_index' => 'main_table.news_id'

            )
        );
        $this->addColumn('news', array(
                'header' => Mage::helper('inchoo_newwssii')->__('News'),
                'index' => 'news',
                'type' => 'text',)
        );
        $this->addColumn('author_id', array(
                'header' => Mage::helper('inchoo_newwssii')->__('Author'),
                'index' => 'username'
            )
        );
        $this->addColumn('is_published', array(
            'header'    => Mage::helper('inchoo_newwssii')->__('Publish status'),
            'index'     => 'is_published',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('inchoo_newwssii')->__('Unpublished'),
                1 => Mage::helper('inchoo_newwssii')->__('Published')
            ),
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('inchoo_newwssii')->__('Date Created'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
