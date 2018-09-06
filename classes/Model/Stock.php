<?php
namespace classes\Model;

use classes\ClassCreator;
use classes\Db\Connection;

class Stock
{
    public function getStocks()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $stocks = $connection->select('stock');

        return $stocks;
    }
}
