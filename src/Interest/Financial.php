<?php

namespace Moguzz\Interest;

use InvalidArgumentException;
use Moguzz\Contracts\Interest;

/**
 * Class Financial
 * @package Moguzz\Interest
 */
final class Financial extends AbstractInterest implements Interest
{
    /**
     * Financial constructor.
     * @param float $interestValue
     */
    public function __construct($interestValue)
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

        if ($numberInstallment == 1) {
            return $totalPurchase;
        }

        return $totalPurchase * $this->getInterestValue() / (1 - pow(1 + $this->getInterestValue(), -$numberInstallment)) * $numberInstallment;
    }
}