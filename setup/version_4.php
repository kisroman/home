<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

//product table
$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'name',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Name'
)->addColumn(
    'price',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Price'
)->createTable('product');
