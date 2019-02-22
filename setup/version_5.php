<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

//arrival tables
$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'shipment',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Shipment'
)->addColumn(
    'total',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Total'
)->addColumn(
    'grand_total',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Grand Total'
)->addColumn(
    'date',
    \Framework\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->createTable('arrival');


$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'arrival_id',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    ['nullable' => false],
    'Arrival Id'
)->addColumn(
    'product_id',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    ['nullable' => false],
    'Product Id'
)->addColumn(
    'product_name',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Product Name'
)->addColumn(
    'cost',
    \Framework\Db\Connection::TYPE_INTEGER,
    20,
    [],
    'Cost'
)->addColumn(
    'qty',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Qty'
)->createTable('arrival_item');
