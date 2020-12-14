<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Interest
 *
 * @package Moguzz\Contracts
 */
interface Interest
{
    public function getValueCalculatedByInstallment($numberInstallment);

    public function appendInterestValue($interestValue);

    public function appendTotalCapital($totalCapital);

    public function resetTotalCapital($totalCapital = 0.00);

    public function resetInterestValue($interestValue = 0.00);

    public function getInterestValue();

    public function getInterestRates();

    public function getTotalCapital();
}
