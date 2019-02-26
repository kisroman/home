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
    'qty',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Qty(can be minus)'
)->addColumn(
    'product_id',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    ['nullable' => false],
    'Product Id'
)->addColumn(
    'total',
    \Framework\Db\Connection::TYPE_TEXT,
    null,
    [],
    'Total(can be minus)'
)->createTable('`product_stock`');
