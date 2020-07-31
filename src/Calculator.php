<?php

namespace Moguzz;

use Moguzz\Contracts\Currency;
use Moguzz\Contracts\Interest;

/**
 * Class Calculator
 * @package Moguzz
 */
class Calculator
{
    private $interest;

    private $currency;

    private $totalPurchase;

    private $numberInstallments;

    private $limitValuePerInstallment;

    private $installments = [];

    /**
     * Calculator constructor.
     * @param Interest $interest
     * @param Currency $currency
     */
    public function __construct(Interest $interest, Currency $currency)
    {
        $this->interest = $interest;
        $this->currency = $currency;
        $this->totalPurchase = 0.00;
        $this->numberInstallments = 12;
        $this->limitValuePerInstallment = 5.00;
    }

    /**
     * @param $totalPurchase
     * @return $this
     */
    public function appendTotalPurchase($totalPurchase)
    {
        $this->totalPurchase += $totalPurchase;
        return $this;
    }

    /**
     * @param $limitValue
     * @return $this
     */
    public function appendLimitValueInstallment($limitValue)
    {
        $this->limitValuePerInstallment = $limitValue;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculateInstallments()
    {
        foreach (range(1, $this->numberInstallments) as $installment) {

            $valueInstallmentCalculated = $this->interest->getValueInstallmentCalculated($this->totalPurchase, $installment);
            $installmentValue = $valueInstallmentCalculated / $installment;
            $addedValue = $valueInstallmentCalculated - $this->totalPurchase;

            if ($installmentValue < $this->limitValuePerInstallment) {
                continue;
            }

            array_push($this->installments,
                new Installment(
                    $installmentValue,
                    $installment,
                    $addedValue
                )
            );
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getInstallments()
    {
        return $this->installments;
    }
}