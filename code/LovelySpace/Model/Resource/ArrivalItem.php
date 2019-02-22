<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalItem
{
    const TABLE_NAME = 'arrival_item';

    public function save(\LovelySpace\Model\ArrivalItem $arrivalItem)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($arrivalItem->getId()) {
            $connection->update(
                self::TABLE_NAME,
                'product_id = "' . $arrivalItem->getProductId() . '"'
                . ', arrival_id = "' . $arrivalItem->getArrivalId() . '"'
                . ', product_name = "' . $arrivalItem->getProductName() . '"'
                . ', cost = ' . $arrivalItem->getCost()
                . ', qty = "' . $arrivalItem->getQty() . '"',
                'id = "' . $arrivalItem->getId() . '"'
            );
        } else {
            $connection->insert(
                self::TABLE_NAME,
                'null, "' . $arrivalItem->getProductId() . '", "' . $arrivalItem->getArrivalId() . '"
                , "' . $arrivalItem->getProductName() . '", "'
                . $arrivalItem->getCost() . '", "' . $arrivalItem->getQty() . '"',
                'id, product_id, arrival_id, product_name, cost, qty'
            );
        }
    }

    public function getArrivalsItemsArray($arrivalId = false)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        if ($arrivalId === false) {
            $arrivalSql = $connection->select(self::TABLE_NAME);
        } else {
            $arrivalSql = $connection->select(self::TABLE_NAME, '*', 'arrival_id = '. $arrivalId);
        }
        $arrivalsArray = $arrivalSql ? $arrivalSql->fetch_all(MYSQLI_ASSOC) : [];

        return $arrivalsArray;
    }

    public function getArrivalItem($arrivalItemId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $arrivalSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $arrivalItemId);

        return $arrivalSql ? $arrivalSql->fetch_assoc() : [];
    }

    public function deleteByArrivalId($arrivalId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $connection->delete(self::TABLE_NAME, 'arrival_id = ' . $arrivalId);
    }

    public function getLastCostForProductByProductId($productId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $arrivalSql = $connection->select(self::TABLE_NAME, 'cost', 'product_id=' . $productId . ' ORDER BY id DESC LIMIT 1');

        return $arrivalSql ? $arrivalSql->fetch_assoc()['cost'] : null;
    }
}
