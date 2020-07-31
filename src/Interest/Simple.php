<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Simple
 * @package Moguzz\Interest
 */
final class Simple implements Interest
{
    /**
     * @var $amount
     */
    private $amount;

    /**
     * Simple constructor.
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
        return $totalPurchase + ($installment > 1 ? ($totalPurchase * $this->amount) : 0.00);
    }
}