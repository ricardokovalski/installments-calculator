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
     * @param $valueInterest
     */
    public function __construct($valueInterest)
    {
        parent::__construct($valueInterest);
    }

    /**
     * @param $totalPurchase
     * @param $numberInstallment
     * @return float|int
     */
    public function getValueInstallmentCalculated($totalPurchase, $numberInstallment)
    {
        return $totalPurchase + ($numberInstallment > 1 ? ($totalPurchase * $this->getValueInterest()) : 0.00);
    }
}