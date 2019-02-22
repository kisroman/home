<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class Arrival
{
    const TABLE_NAME = 'arrival';

    public function save(\LovelySpace\Model\Arrival $arrival)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($arrival->getId()) {
            $result= $connection->update(
                self::TABLE_NAME,
                'shipment = "' . $arrival->getShipment() . '"'
                . ', total = ' . $arrival->getTotal()
                . ', grand_total = ' . $arrival->getGrandTotal()
                . ', date = "' . $arrival->getDate() . '"',
                'id = "' . $arrival->getId() . '"'
            );
        } else {
            $result = $connection->insert(
                self::TABLE_NAME,
                'null, "' . $arrival->getShipment() . '", "' . $arrival->getTotal() . '", "'
                . $arrival->getGrandTotal() . '", "' . $arrival->getDate() . '"',
                'id, shipment, total, grand_total, date'
            );
        }
        return $result;
    }

    public function getArrivalsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $arrivalSql = $connection->select(self::TABLE_NAME);
        $arrivalsArray = $arrivalSql->fetch_all(MYSQLI_ASSOC);

        return $arrivalsArray;
    }

    public function getArrival($arrivalId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $arrivalSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $arrivalId);

        return $arrivalSql ? $arrivalSql->fetch_assoc() : [];
    }
}
