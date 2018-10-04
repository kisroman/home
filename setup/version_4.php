<?php
/** @var \classes\Db\Connection $connection */
$connection = \classes\ClassCreator::includeClass(\classes\Db\Connection::class);

$connection->addColumn(
    'id',
    \classes\Db\Connection::TYPE_SMALLINT,
    null,
    ['auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
    'ID'
)->addColumn(
    'name',
    \classes\Db\Connection::TYPE_TEXT,
    20,
    ['nullable' => false],
    'Name'
)->addColumn(
    'number',
    \classes\Db\Connection::TYPE_TEXT,
    20,
    [],
    'Number'
)->addColumn(
    'date',
    \classes\Db\Connection::TYPE_DATE,
    null,
    [],
    'Date'
)->createTable('meter_readings');
