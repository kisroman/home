<?php

namespace LovelySpace\Model\Resource\Order;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\Resource\AbstractModel;

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

    public function getModelsArrayWithInDate($dateFrom, $dateTo)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $whereCondition = '';

        if ($dateFrom) {
            $whereCondition = '`date` >= "'. $dateFrom . '"';
            if ($dateTo) {
                $whereCondition .= ' AND `date` <= "' . $dateTo . '"';
            }
        }

        if (!$dateFrom && $dateTo) {
            $whereCondition = '`date` <= "'. $dateTo . '"';
        }

        $orderSql = $connection->select(self::TABLE_NAME, '*', $whereCondition, '', '`date` DESC');
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
