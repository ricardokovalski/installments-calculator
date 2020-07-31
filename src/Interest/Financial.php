<?php

namespace Moguzz\Interest;

use Moguzz\Contracts\Interest;

/**
 * Class Financial
 * @package Moguzz\Interest
 */
final class Financial implements Interest
{
    /**
     * @var $amount
     */
    private $amount;

    /**
     * Financial constructor.
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
        if ($installment == 1) {
            return $totalPurchase;
        }

        return $totalPurchase * $this->amount / (1 - pow(1 + $this->amount, -$installment)) * $installment;
    }
}