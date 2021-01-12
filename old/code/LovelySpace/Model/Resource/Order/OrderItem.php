<?php

namespace LovelySpace\Model\Resource\Order;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\Resource\AbstractModel;

class OrderItem extends AbstractModel
{
    const TABLE_NAME = '`order_item`';

    public function getModelsArray($orderId = false)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        if ($orderId === false) {
            $orderSql = $connection->select(self::TABLE_NAME);
        } else {
            $orderSql = $connection->select(self::TABLE_NAME, '*', 'order_id = '. $orderId);
        }
        $ordersArray = $orderSql ? $orderSql->fetch_all(MYSQLI_ASSOC) : [];

        return $ordersArray;
    }

    public function deleteByOrderId($orderId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $connection->delete(self::TABLE_NAME, 'order_id = ' . $orderId);
    }
}
