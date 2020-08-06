<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Financial
 * @package Moguzz\Interest
 */
final class Financial extends AbstractInterest implements Interest
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
     * @return float|int|mixed
     */
    public function getValueInstallmentCalculated($totalPurchase, $numberInstallment)
    {
        if ($numberInstallment == 1) {
            return $totalPurchase;
        }

        return $totalPurchase * $this->getValueInterest() / (1 - pow(1 + $this->getValueInterest(), -$numberInstallment)) * $numberInstallment;
    }
}