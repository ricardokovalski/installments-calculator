<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Simple
 * @package Moguzz\Interest
 */
final class Simple extends AbstractInterest implements Interest
{
    /**
     * Compound constructor.
     * @param $interestValue
     */
    public function __construct($interestValue)
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

        return $totalPurchase + $this->getInterestValue() * $totalPurchase;
    }
}