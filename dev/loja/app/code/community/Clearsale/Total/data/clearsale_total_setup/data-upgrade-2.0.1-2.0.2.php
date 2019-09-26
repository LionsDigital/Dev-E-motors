<?php
/** @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order'),
    array('cs_status' => null),
    "cs_status IN('OLD', 'NULL')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order'),
    array('cs_status' => 'approved'),
    "cs_status IN('APA', 'APM')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order'),
    array('cs_status' => 'reproved'),
    "cs_status IN('RPM', 'SUS', 'CAN', 'FRD', 'RPA', 'RPP')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order'),
    array('cs_status' => 'waiting_approval'),
    "cs_status IN('NVO', 'AMA')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order_grid'),
    array('cs_status' => null),
    "cs_status IN('OLD', 'NULL')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order_grid'),
    array('cs_status' => 'approved'),
    "cs_status IN('APA', 'APM')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order_grid'),
    array('cs_status' => 'reproved'),
    "cs_status IN('RPM', 'SUS', 'CAN', 'FRD', 'RPA', 'RPP')"
);

$updateQuery = $installer->getConnection()->update(
    $installer->getTable('sales/order_grid'),
    array('cs_status' => 'waiting_approval'),
    "cs_status IN('NVO', 'AMA')"
);
