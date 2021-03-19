<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Adapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface InterestAdapter
{
    /**
     * @param $installmentNumber
     * @return mixed
     */
    public function getInterestByInstallmentNumber($installmentNumber);
}
