<?php

namespace Moguzz\Contracts;

/**
 * Interface Interest
 * @package Moguzz\Contracts
 */
interface Interest
{
    /**
     * @param $totalPurchase
     * @param $numberInstallment
     * @return mixed
     */
    public function getValueInstallmentCalculated($totalPurchase, $numberInstallment);
}