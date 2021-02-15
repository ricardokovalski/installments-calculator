<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Adapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface Adapter
{
    //public function getValueCalculatedByInstallment($numberInstallment);

    public function getInterestByInstallmentNumber($installmentNumber);
}
