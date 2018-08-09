<?php
namespace classes\Model;

use classes\ClassCreator;
use classes\Db\Connection;

class Rate
{
    public function getRates()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $rates = $connection->select('rate');

        return $rates;
    }
}
