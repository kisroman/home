<?php
/** @var \classes\Db\Connection $connection */
$connection = \classes\ClassCreator::includeClass(\classes\Db\Connection::class);

$connection->addColumn(
    'id',
    \classes\Db\Connection::TYPE_SMALLINT,
    null,
    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'stock',
    \classes\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Stock'
)->addColumn(
    'source',
    \classes\Db\Connection::TYPE_TEXT,
    20,
    [],
    'Source'
)->addColumn(
    'sum',
    \classes\Db\Connection::TYPE_FLOAT,
    null,
    [],
    'Sum'
)->addColumn(
    'currency',
    \classes\Db\Connection::TYPE_TEXT,
    10,
    [],
    'Currency'
)->addColumn(
    'active',
    \classes\Db\Connection::TYPE_BOOLEAN,
    null,
    [],
    'Is active'
)->addColumn(
    'date',
    \classes\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->createTable('finance');
