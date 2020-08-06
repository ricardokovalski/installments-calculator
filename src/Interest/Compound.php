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
        return $totalPurchase * pow((1 + $this->getValueInterest()), $numberInstallment - 1);
    }
}