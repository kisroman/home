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
    'sum',
    \Framework\Db\Connection::TYPE_INTEGER,
    null,
    [],
    'Sum'
)->addColumn(
    'date',
    \Framework\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->addColumn(
    'comment',
    \Framework\Db\Connection::TYPE_TEXT,
    50,
    ['nullable' => false],
    'Comment'
)->createTable('`spending`');
