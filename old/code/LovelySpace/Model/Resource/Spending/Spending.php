<?php

namespace LovelySpace\Model\Resource\Spending;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\Resource\AbstractModel;

class Spending extends AbstractModel
{
    const TABLE_NAME = '`spending`';

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

        $modelSql = $connection->select(self::TABLE_NAME, '*', $whereCondition, '', '`date` DESC');
        $modelsArray = $modelSql ? $modelSql->fetch_all(MYSQLI_ASSOC) : [];

        return $modelsArray;
    }
}
