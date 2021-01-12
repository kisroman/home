<?php

namespace FinanceManagement\Model;

use ClassCreator;
use Framework\Db\Connection;

class Rate
{
    private $rates = null;

    /**
     * @return bool|\mysqli_result|null
     */
    public function getRates()
    {
        if ($this->rates === null) {
            /** @var Connection $connection */
            $connection = ClassCreator::get(Connection::class);
            $this->rates = $connection->select('rate');
        }

        return $this->rates;
    }

    /**
     * @param $sum
     * @param $fromCurrency
     *
     * @return float|int
     */
    public function getUahSumByCurrency($sum, $fromCurrency)
    {
        $rate = $this->getRateByCurrency($fromCurrency);
        $convertedSum = $sum * $rate;

        return $convertedSum;
    }

    /**
     * @param $sum
     * @param $fromCurrency
     *
     * @return float|int
     */
    public function getUsdSumByCurrency($sum, $fromCurrency)
    {
        $rate = $this->getRateByCurrency($fromCurrency);
        $sum = $sum * $rate;
        $rate = $this->getRateByCurrency('USD');
        $convertedSum = $sum / $rate;

        return $convertedSum;
    }

    /**
     * @param $sum
     * @param $fromCurrency
     *
     * @return float|int
     */
    public function getEurSumByCurrency($sum, $fromCurrency)
    {
        $rate = $this->getRateByCurrency($fromCurrency);
        $sum = $sum * $rate;
        $rate = $this->getRateByCurrency('EUR');
        $convertedSum = $sum / $rate;

        return $convertedSum;
    }

    /**
     * @param $currency
     *
     * @return null
     */
    private function getRateByCurrency($currency)
    {
        $resultRate = null;
        $rates = $this->getRates();
        foreach ($rates as $rate) {
            if ($rate['currency'] === $currency) {
                $resultRate = $rate['coefficient'];
                break;
            }
        }

        return $resultRate;
    }

    public function save($data)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $ifExist = $connection->select('rate', '*', 'currency = "' . $data['currency'] . '"');

        if ($ifExist->fetch_row()) {
            $connection->update(
                'rate',
                'coefficient = ' . $data['coefficient'],
                'currency = "' . $data['currency'] . '"'
            );
        } else {
            $connection->insert(
                'rate',
                '"' . $data['coefficient'] . '", "' . $data['currency'] . '"',
                'coefficient, currency'
            );
        }
    }
}
