<?php
/** @var \Framework\Db\Connection $connection */
$connection = \ClassCreator::get(\Framework\Db\Connection::class);

$connection->dropColumn('arrival', 'shipment')->dropColumn('arrival', 'grand_total');
