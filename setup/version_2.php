<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

$connection->addColumn(
    'id',
    \Framework\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'name',
    \Framework\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Stock'
)->createTable('stock');
