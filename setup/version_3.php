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
    'stock',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Stock'
)->addColumn(
    'source',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    [],
    'Source'
)->addColumn(
    'sum',
    \Framework\Db\Connection::TYPE_FLOAT,
    null,
    [],
    'Sum'
)->addColumn(
    'currency',
    \Framework\Db\Connection::TYPE_TEXT,
    10,
    [],
    'Currency'
)->addColumn(
    'active',
    \Framework\Db\Connection::TYPE_BOOLEAN,
    null,
    [],
    'Is active'
)->addColumn(
    'date',
    \Framework\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->addColumn(
    'comment',
    \Framework\Db\Connection::TYPE_TEXT,
    256,
    [],
    'Comment'
)->createTable('finance');
