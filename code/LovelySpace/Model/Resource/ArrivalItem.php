<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalItem extends AbstractModel
{
    const TABLE_NAME = '`arrival_item`';

    public function getModelsArray($arrivalId = false)
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
