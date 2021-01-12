<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

$connection->addColumnForExistingTable('arrival', 'shop_id', \Framework\Db\Connection::TYPE_INTEGER, 20, [], 'Shop');

//ALTER TABLE arrival ADD COLUMN shop_id integer(20)
