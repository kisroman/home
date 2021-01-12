<?php

namespace LovelySpace\Model\Resource\Product;

use ClassCreator;
use Framework\Db\Connection;

class ProductStock
{
    public function getModelsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $orderItemsQtySql = $connection->select('order_item', 'product_id, SUM(qty) as qty', '', 'product_id');
        $orderItemsQty = $orderItemsQtySql ? $orderItemsQtySql->fetch_all(MYSQLI_ASSOC) : [];
        $arrivalItemsQtySql = $connection->select('arrival_item', 'product_id, SUM(qty) as qty', '', 'product_id');
        $arrivalItemsQty = $arrivalItemsQtySql ? $arrivalItemsQtySql->fetch_all(MYSQLI_ASSOC) : [];

        $qtyByProductsId = [];

        foreach ($arrivalItemsQty as $arrivalItemQty) {
            $qtyByProductsId[$arrivalItemQty['product_id']]['qty'] = $arrivalItemQty['qty'];
            $qtyByProductsId[$arrivalItemQty['product_id']]['product_id'] = $arrivalItemQty['product_id'];
        }

        foreach ($orderItemsQty as $orderItemQty) {
            if (isset($qtyByProductsId[$orderItemQty['product_id']]['qty'])) {
                $qtyByProductsId[$orderItemQty['product_id']]['qty'] -= $orderItemQty['qty'];
            } else {
                $qtyByProductsId[$orderItemQty['product_id']]['qty'] = '-' . $orderItemQty['qty'];
                $qtyByProductsId[$orderItemQty['product_id']]['product_id'] = $orderItemQty['product_id'];
            }
        }

        return $qtyByProductsId;
    }
}
