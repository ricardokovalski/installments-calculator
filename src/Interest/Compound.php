<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Compound
 * @package Moguzz\Interest
 */
final class Compound extends AbstractInterest implements Interest
{
    /**
     * Compound constructor.
     * @param float $interestValue
     */
    public function __construct($interestValue = 0.00)
    {
        parent::__construct($interestValue);
    }

    /**
     * @param $totalPurchase
     * @param $numberInstallment
     * @return float|int
     */
    public function getValueInstallmentCalculated($totalPurchase, $numberInstallment)
    {
        if ($this->interestValueIsZeroed()) {
            return $totalPurchase + $this->getInterestValue();
        }

        return $totalPurchase * pow((1 + $this->getInterestValue()), $numberInstallment - 1);
    }
}