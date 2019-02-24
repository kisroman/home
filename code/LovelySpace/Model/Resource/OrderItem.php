<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class OrderItem
{
    const TABLE_NAME = 'order_item';

    public function save(\LovelySpace\Model\OrderItem $orderItem)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($orderItem->getId()) {
            $connection->update(
                self::TABLE_NAME,
                'product_id = "' . $orderItem->getProductId() . '"'
                . ', order_id = "' . $orderItem->getOrderId() . '"'
                . ', product_name = "' . $orderItem->getProductName() . '"'
                . ', price = ' . $orderItem->getPrice()
                . ', qty = "' . $orderItem->getQty() . '"',
                'id = "' . $orderItem->getId() . '"'
            );
        } else {
            $connection->insert(
                self::TABLE_NAME,
                'null, "' . $orderItem->getProductId() . '", "' . $orderItem->getOrderId() . '"
                , "' . $orderItem->getProductName() . '", "'
                . $orderItem->getPrice() . '", "' . $orderItem->getQty() . '"',
                'id, product_id, order_id, product_name, price, qty'
            );
        }
    }

    public function getOrdersItemsArray($orderId = false)
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

    public function getOrderItem($orderItemId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $orderSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $orderItemId);

        return $orderSql ? $orderSql->fetch_assoc() : [];
    }

    public function deleteByOrderId($orderId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $connection->delete(self::TABLE_NAME, 'order_id = ' . $orderId);
    }
}
