<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'client_id',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    ['nullable' => false],
    'Client Id'
)->addColumn(
    'total',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Total'
)->addColumn(
    '`date`',
    \Framework\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->createTable('`order`');

$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'order_id',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    ['nullable' => false],
    'Order Id'
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
    'price',
    \Framework\Db\Connection::TYPE_INTEGER,
    20,
    [],
    'price'
)->addColumn(
    'qty',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Qty'
)->createTable('order_item');
