<?php

namespace classes\Model;

use classes\ClassCreator;
use classes\Db\Connection;

class FinanceDetails
{
    public function save($data)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $data['date'] = date('o-m-d', strtotime($data['date']));
        $data['active'] = isset($data['active']) ? 1 : 0;
        $preparedData = [];
        foreach ($data as $key => $datum) {
            $preparedData['`' . $key . '`'] = '"' . $datum . '"';
        }

        $connection->insert(
            'finance',
            implode(', ', array_values($preparedData)),
            implode(', ', array_keys($preparedData))
        );

        return $this;
    }

    public function getFinanceDetails($date)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $financeDetails = $connection->select('finance', '*', '`date` = "' . $date . '"');

        return $financeDetails;
    }
}
