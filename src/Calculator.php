<?php

namespace Moguzz;

use InvalidArgumentException;
use Moguzz\Contracts\Currency;
use Moguzz\Contracts\Interest;

/**
 * Class Calculator
 * @package Moguzz
 */
class Calculator
{
    use FormattingTrait;

    private $interest;

    private $currency;

    private $totalPurchase;

    private $numberMaxInstallments;

    private $limitInstallments;

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
        $this->setupSettings();
    }

    /**
     * Making a configuration setup
     */
    private function setupSettings()
    {
        $this->totalPurchase = 0.00;
        $this->numberMaxInstallments = 12;
        $this->limitInstallments = true;
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
     * @param $number
     * @return $this
     */
    public function appendNumberInstallments($number)
    {
        $this->verifyNumberInstallments($number);

        $this->numberMaxInstallments = $number;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function isLimitingInstallments($key)
    {
        $this->limitInstallments = $key;
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
        foreach (range(1, $this->numberMaxInstallments) as $numberInstallment) {

            $originalValueInstallment = $this->interest->getValueInstallmentCalculated($this->totalPurchase, $numberInstallment);
            $valueInstallmentCalculated = $originalValueInstallment / $numberInstallment;
            $addedValue = $originalValueInstallment - $this->totalPurchase;

            if ($this->limitInstallments && $valueInstallmentCalculated < $this->limitValuePerInstallment) {
                break;
            }

            array_push($this->installments, new Installment($valueInstallmentCalculated, $numberInstallment, $addedValue));
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

    /**
     * @param $number
     */
    private function verifyNumberInstallments($number)
    {
        if ($number < 1) {
            throw new InvalidArgumentException('The minimum number of installments cannot be less than zero.');
        }

        if ($number > 12) {
            throw new InvalidArgumentException('The maximum number of installments cannot be greater than twelve.');
        }
    }
}