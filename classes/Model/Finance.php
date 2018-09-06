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
        $sumByDate = [];
        foreach ($dates as $date) {
            list($sumUah, $activeSumUah) = $financeDetailsModel->getSumsUahByDate($date);
            $sumByDate[$date] = [
                'sumUah' => $sumUah,
                'activeSumUah' => $activeSumUah,
            ];
        }

        return $sumByDate;
    }
}
