<?php

namespace classes\Model;

use classes\ClassCreator;
use classes\Db\Connection;

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
            $connection = ClassCreator::includeClass(Connection::class);
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
}
