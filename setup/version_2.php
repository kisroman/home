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
    'currency',
    \classes\Db\Connection::TYPE_TEXT,
    10,
    ['nullable' => false],
    'Currency'
)->addColumn(
    'coefficient',
    \classes\Db\Connection::TYPE_FLOAT,
    null,
    [],
    'Coefficient'
)->createTable('rate');
