<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Compound
 * @package Moguzz\Interest
 */
final class Compound implements Interest
{
    /**
     * @var $amount
     */
    private $amount;

    /**
     * Compound constructor.
     * @param $amount
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param $totalPurchase
     * @param $installment
     * @return float|int
     */
    public function getValueInstallmentCalculated($totalPurchase, $installment)
    {
        return $totalPurchase * pow((1 + $this->amount), $installment - 1);
    }
}