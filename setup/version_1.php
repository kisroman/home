<?php
$connection->addColumn(
    'version',
    \classes\Db\Connection::TYPE_TEXT,
    128,
    ['nullable' => false, 'unique' => true],
    'DB version'
)->createTable('db_version');
