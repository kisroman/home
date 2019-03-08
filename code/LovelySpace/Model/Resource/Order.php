<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class Order extends AbstractModel
{
    const TABLE_NAME = '`order`';

    public function getModelsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $orderSql = $connection->select(self::TABLE_NAME, '*', '', '', '`date` DESC');
        $ordersArray = $orderSql ? $orderSql->fetch_all(MYSQLI_ASSOC) : [];

        return $ordersArray;
    }

    public function getOrder($orderId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $orderSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $orderId);

        return $orderSql ? $orderSql->fetch_assoc() : [];
    }
}
