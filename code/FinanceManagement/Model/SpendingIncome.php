<?php

namespace FinanceManagement\Model;

class SpendingIncome
{
    public function getSpendingIncomeByMonthAndYear($differenceByDate)
    {
        $spendingIncomeByMonthAndYear = [];

        //drop first income
        array_shift($differenceByDate);
        // Desc order by date
        krsort($differenceByDate);

        foreach ($differenceByDate as $date => $sum) {
            $year = date('y', strtotime($date));
            $month = date('m', strtotime($date));
            if ($sum < 0) {
                if (!isset($spendingIncomeByMonthAndYear[$year][$month]['spending'])) {
                    $spendingIncomeByMonthAndYear[$year][$month]['spending'] = 0;
                }
                $spendingIncomeByMonthAndYear[$year][$month]['spending'] += $sum;
            } else {
                if (!isset($spendingIncomeByMonthAndYear[$year][$month]['income'])) {
                    $spendingIncomeByMonthAndYear[$year][$month]['income'] = 0;
                }
                $spendingIncomeByMonthAndYear[$year][$month]['income'] += $sum;
            }
        }

        return $spendingIncomeByMonthAndYear;
    }
}
