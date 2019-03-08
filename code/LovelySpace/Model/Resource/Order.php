<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class Order
{
    const TABLE_NAME = '`order`';

    public function save(\LovelySpace\Model\Order $order)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($order->getId()) {
            $result= $connection->update(
                self::TABLE_NAME,
                'total = "' . $order->getTotal()
                . '", client_id = "' . $order->getClientId() . '"'
                . ', date = "' . $order->getDate() . '"',
                'id = "' . $order->getId() . '"'
            );
        } else {
            $result = $connection->insert(
                self::TABLE_NAME,
                'null, "' . $order->getClientId() . '", "' . $order->getTotal() . '", "' . $order->getDate() . '"',
                'id, client_id, total, date'
            );
        }
        return $result;
    }

    public function getOrdersArray()
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
