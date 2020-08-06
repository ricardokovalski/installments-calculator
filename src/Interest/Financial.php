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
     * @param float $valueInterest
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
        if ($this->getValueInterest() == 0.00) {
            throw new InvalidArgumentException('Interest value equal zero!');
        }

        if ($numberInstallment == 1) {
            return $totalPurchase;
        }

        return $totalPurchase * $this->getValueInterest() / (1 - pow(1 + $this->getValueInterest(), -$numberInstallment)) * $numberInstallment;
    }
}