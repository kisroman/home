<?php
namespace FinanceManagement\Model;

use ClassCreator;
use Framework\Db\Connection;

class Stock
{
    public function getStocks()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $stocks = $connection->select('stock');

        return $stocks;
    }
}
