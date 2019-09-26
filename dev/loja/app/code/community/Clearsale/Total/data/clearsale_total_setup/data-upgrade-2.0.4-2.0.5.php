<?php
/** @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
$insertQuery = $installer->getConnection()->query("
  INSERT INTO clearsale_queue (order_id, status)
  SELECT entity_id, 'retry' FROM sales_flat_order WHERE cs_status LIKE 'Aguardando%';
");

$installer->endSetup();
