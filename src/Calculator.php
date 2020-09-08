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

    /**
     * @var Interest $interest
     */
    private $interest;

    /**
     * @var Currency $currency
     */
    private $currency;

    /**
     * @var float $totalPurchase
     */
    private $totalPurchase;

    /**
     * @var integer $numberMaxInstallments
     */
    private $numberMaxInstallments;

    /**
     * @var boolean $limitInstallments
     */
    private $limitInstallments;

    /**
     * @var float $limitValueInstallment
     */
    private $limitValueInstallment;

    /**
     * @var InstallmentCollection
     */
    private $installmentCollection;

    /**
     * Calculator constructor.
     * @param Interest $interest
     * @param Currency $currency
     */
    public function __construct(Interest $interest, Currency $currency)
    {
        $this->interest = $interest;
        $this->currency = $currency;
        $this->installmentCollection = new InstallmentCollection();
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
        $this->limitValueInstallment = 5.00;
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
     * @param $number
     * @return bool
     */
    private function verifyNumberInstallments($number)
    {
        if ($number < 1) {
            throw new InvalidArgumentException('The minimum number of installments cannot be less than zero.');
        }

        if ($number > 12) {
            throw new InvalidArgumentException('The maximum number of installments cannot be greater than twelve.');
        }

        return true;
    }

    /**
     * @param $key
     * @return $this
     */
    public function hasLimitingInstallments($key)
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
        $this->limitValueInstallment = $limitValue;
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

            if ($this->installmentValueIsLessThanLimitValue($valueInstallmentCalculated)) {
                break;
            }

            $this->installmentCollection->appendInstallment(
                new Installment($valueInstallmentCalculated, $numberInstallment, $addedValue)
            );
        }

        return $this;
    }

    /**
     * @param $valueInstallmentCalculated
     * @return bool
     */
    private function installmentValueIsLessThanLimitValue($valueInstallmentCalculated)
    {
        return $this->limitInstallments && $valueInstallmentCalculated < $this->limitValueInstallment;
    }

    /**
     * @return mixed
     */
    public function getTotalPurchase()
    {
        return $this->totalPurchase;
    }

    /**
     * @return mixed
     */
    public function getNumberMaxInstallments()
    {
        return $this->numberMaxInstallments;
    }

    /**
     * @return mixed
     */
    public function getLimitValueInstallment()
    {
        return $this->limitValueInstallment;
    }

    /**
     * @return mixed
     */
    public function getCollectionInstallments()
    {
        return $this->installmentCollection;
    }
}