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
     * Simple constructor.
     * @param float $interestValue
     */
    public function __construct($interestValue = 0.00)
    {
        parent::__construct($interestValue);
    }

    /**
     * @param $totalPurchase
     * @param $numberInstallment
     * @return float|int|mixed
     */
    public function getValueInstallmentCalculated($totalPurchase, $numberInstallment)
    {
        if ($this->interestValueIsZeroed()) {
            return $totalPurchase + $this->getInterestValue();
        }

        return $totalPurchase + $this->getInterestValue() * $totalPurchase;
    }
}