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
    'currency',
    \Framework\Db\Connection::TYPE_TEXT,
    10,
    ['nullable' => false],
    'Currency'
)->addColumn(
    'coefficient',
    \Framework\Db\Connection::TYPE_FLOAT,
    null,
    [],
    'Coefficient'
)->createTable('rate');
