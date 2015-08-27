<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('inchoo_newwssii/news'))
    ->addColumn(
        'news_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Id'
    )
    ->addColumn(
        'news',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array(
            'nullable' => false,
        ),
        'News text'
    )
    ->addColumn(
        'author_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'nullable' => true,
            'unsinged' => true
        ),
        'Fk on admin_user user_id'
    )
    ->addColumn(
        'is_published',
        Varien_Db_Ddl_Table::TYPE_TINYINT,
        null,
        array(
            'nullable'  => true,
            'default' => null,
            ),
        'Published or Unpublished'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array('nullable'  => false),
        'News Created Time'
    )
    ->addForeignKey(
        $installer->getFkName('inchoo_newwssii/news', 'author_id', 'admin_user', 'user_id'),
        'author_id',
        $installer->getTable('admin_user'),
        'user_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Inchoo_Newwssii News Entity');

$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('inchoo_newwssii/news_comments'))
    ->addColumn(
        'comment_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Id'
    )
    ->addColumn(
        'comment',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array(
            'nullable' => false,
        ),
        'News text'
    )
    ->addColumn(
        'news_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsinged' => true,
            'nullable' => false,
        ),
        'News ID'
    )
    ->addColumn(
        'author_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        array(
            'nullable' => true,
            'unsinged' => true
        ),
        'Fk on customer_entity entity_id'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array('nullable'  => false),
        'Comment created time'
    )
    ->addColumn(
        'is_published',
        Varien_Db_Ddl_Table::TYPE_TINYINT,
        null,
        array(
            'nullable'  => true,
            'default' => null,
        ),
        'Published or Unpublished'
    )
    ->addForeignKey(
        $installer->getFkName('inchoo_newwssii/news_comments', 'news_id', 'inchoo_newwssii/news', 'news_id'),
        'news_id',
        $installer->getTable('inchoo_newwssii/news'),
        'news_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName('inchoo_newwssii/news_comments', 'author_id', 'customer/entity', 'entity_id'),
        'author_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Inchoo_Newwssii News Comments Entity');

$installer->getConnection()->createTable($table);

$installer->endSetup();