<?php

$installer = $this;
$connection = $installer->getConnection();

if (!$connection->tableColumnExists($installer->getTable('sales/order'), 'cs_status')) {
    $connection
        ->addColumn($installer->getTable('sales/order'), 'cs_status', [
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => '255',
            'nullable' => true,
            'comment' => 'Clear Sale Status'
        ]);
}

if (!$connection->tableColumnExists($installer->getTable('sales/order_grid'), 'cs_status')) {
    $connection
        ->addColumn($installer->getTable('sales/order_grid'), 'cs_status', [
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => '255',
            'nullable' => true,
            'comment' => 'Clear Sale Status'
        ]);
}

if (!$connection->isTableExists($installer->getTable('clearsale_total/queue'))) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('clearsale_total/queue'))
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Entity ID')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable'  => false,
        ), 'The order ID')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_VARCHAR, '255', array(
        ), 'The current status')
        ->setComment('ClearSale Queue list');

    $connection->createTable($table);
}

$connection->modifyColumn($installer->getTable('sales/order'), 'cs_status', 'VARCHAR(255)');
$connection->modifyColumn($installer->getTable('sales/order_grid'), 'cs_status', 'VARCHAR(255)');

if (!$connection->isTableExists($installer->getTable('clearsale_total/history'))) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('clearsale_total/history'))
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Entity ID')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable'  => false,
        ), 'The order ID')
        ->addColumn('status_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, '3', array(
        ), 'The current status')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        ), 'The date of the transaction')
        ->setComment('ClearSale order history');

    $connection->createTable($table);
}
if (!$connection->tableColumnExists($installer->getTable('clearsale_total/history'), 'updated_at')) {
    $table = $installer->getConnection()->addColumn(
        $installer->getTable('clearsale_total/history'),
        'updated_at',
        'DATETIME NULL'
    );
}

if (!$connection->tableColumnExists($installer->getTable('sales/order'), 'cs_session_id')) {
    $connection
        ->addColumn($installer->getTable('sales/order'), 'cs_session_id', [
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => '255',
            'nullable' => true,
            'comment' => 'Clear Sale Finger Print'
        ]);
}

// ==================================================================
//
// Add custom statuses
//
// ------------------------------------------------------------------

$statusTable = $installer->getTable('sales/order_status');
$statusStateTable = $installer->getTable('sales/order_status_state');

// Insert statuses
$installer->getConnection()->insertArray(
    $statusTable,
    array(
        'status',
        'label'
    ),
    array(
        array('status' => 'clearsale_approved', 'label' => 'Aprovado Clearsale'),
        array('status' => 'clearsale_reproved', 'label' => 'Reprovado Clearsale'),
        array('status' => 'approved_manually_clearsale', 'label' => 'Aprovado Clearsale Manualmente')
    )
);

// Insert states and mapping of statuses to states
$installer->getConnection()->insertArray(
    $statusStateTable,
    array(
        'status',
        'state',
        'is_default'
    ),
    array(
        array(
            'status' => 'clearsale_approved',
            'state' => 'processing',
            'is_default' => 0
        ),
        array(
            'status' => 'clearsale_reproved',
            'state' => 'processing',
            'is_default' => 0
        ),
        array(
            'status' => 'approved_manually_clearsale',
            'state' => 'processing',
            'is_default' => 0
        )
    )
);

$installer->endSetup();
