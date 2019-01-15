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
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        if (!isset($data['active'])) {
            $data['active'] = 0;
        } else {
            if ($data['active'] == 1 || $data['active'] === 'on') {
                $data['active'] = 1;
            }
        }
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

    public function getFinanceDetailsByDate($date)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $date = date('Y-m-d', strtotime($date));

        $financeDetails = $connection->select('finance', '*', '`date` = "' . $date . '"');

        return $financeDetails;
    }

    public function getFinanceDetails()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $financeDetails = $connection->select('finance');

        return $financeDetails;
    }

    public function getSumsUahByDate($date)
    {
        $financeDetails = $this->getFinanceDetailsByDate($date);

        /** @var \classes\Model\Rate $rate */
        $rate = \classes\ClassCreator::includeClass(\classes\Model\Rate::class);

        $sumUah = 0;
        $activeSumUah = 0;
        foreach ($financeDetails as $financeDetail) {
            $sumUah += $rate->getUahSumByCurrency($financeDetail['sum'], $financeDetail['currency']);
            if ($financeDetail['active']) {
                $activeSumUah += $rate->getUahSumByCurrency($financeDetail['sum'], $financeDetail['currency']);
            }
        }

        return [$sumUah, $activeSumUah];
    }

    public function getCommentByDate($date)
    {
        $financeDetails = $this->getFinanceDetailsByDate($date);

        $comment = '';
        foreach ($financeDetails as $financeDetail) {
            if (isset($financeDetail['comment']) && $financeDetail['comment']) {
                $comment .= $financeDetail['comment']. ', ';
            }
        }

        $comment =  substr($comment, 0, -2);

        return $comment;
    }

    public function createDuplicateForDate($date)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $maxDate = array_pop($connection->selectMax('finance', 'date')->fetch_row());

        $financeDetails = $this->getFinanceDetailsByDate($maxDate);

        foreach ($financeDetails as $financeDetail) {
            unset($financeDetail['id']);
            unset($financeDetail['comment']);
            $financeDetail['date'] = $date;
            $this->save($financeDetail);
        }
    }

    public function delete($id)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);
        $connection->delete('finance', '`id`=' . $id);
    }

    public function update($request)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::includeClass(Connection::class);

        if (isset($request['sum'])) {
            $connection->update('finance', '`sum` = ' . $request['sum'], '`id`=' . $request['id']);
        }

        if (isset($request['comment'])) {
            $connection->update('finance', '`comment` = "' . $request['comment'] . '"', '`id`=' . $request['id']);
        }
    }
}
