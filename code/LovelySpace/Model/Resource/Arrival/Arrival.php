<?php

namespace LovelySpace\Model\Resource\Arrival;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\Resource\AbstractModel;

class Arrival extends AbstractModel
{
    const TABLE_NAME = '`arrival`';

    public function getModelsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $arrivalSql = $connection->select(self::TABLE_NAME, '*', '', '', '`date` DESC');
        $arrivalsArray = $arrivalSql ? $arrivalSql->fetch_all(MYSQLI_ASSOC) : [];

        return $arrivalsArray;
    }
}
