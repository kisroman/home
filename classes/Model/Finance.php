<?php

namespace classes\Model;

use classes\ClassCreator;
use classes\Db\Connection;

class Finance
{
    public function getFinances()
    {
        /** @var FinanceDetails $financeDetailsModel */
        $financeDetailsModel = ClassCreator::includeClass(FinanceDetails::class);
        $financeDetails = $financeDetailsModel->getFinanceDetails();

        $dates = [];
        foreach ($financeDetails as $financeDetail) {
            $dates[] = $financeDetail['date'];
        }
        $infoByDate = [];
        foreach ($dates as $date) {
            list($sumUah, $activeSumUah) = $financeDetailsModel->getSumsUahByDate($date);
            $comment = $financeDetailsModel->getCommentByDate($date);

            $infoByDate[$date] = [
                'sumUah' => $sumUah,
                'activeSumUah' => $activeSumUah,
                'comment' => $comment
            ];
        }

        return $infoByDate;
    }

    public function getFinancesByMonth()
    {
        $financesByMonth = [];
        $financesByDate = $this->getFinances();

        foreach ($financesByDate as $date => $finance) {
            $month = date('m', strtotime($date));
            if (!isset($financesByMonth[$month]))
            {
                $financesByMonth[$month] = [
                    'min' => $finance,
                    'max' => $finance
                ];
            } else {
                if ($financesByMonth[$month]['min']['sumUah'] > $finance['sumUah']) {
                    $financesByMonth[$month]['min'] = $finance;
                }
                if ($financesByMonth[$month]['max']['sumUah'] < $finance['sumUah']) {
                    $financesByMonth[$month]['max'] = $finance;
                }
            }
        }

        return $financesByMonth;
    }
}
