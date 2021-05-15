<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Adapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface InterestAdapter
{
    public function appendInterestValue($interestValue);

    public function appendTotalCapital($totalCapital);

    public function resetTotalCapital($totalCapital);

    public function resetInterestValue($interestValue);

    public function getInterestValue();

    public function getInterestRates();

    public function getTotalCapital();

    /**
     * @param $installmentNumber
     * @return mixed
     */
    public function getInterestByInstallmentNumber($installmentNumber);
}
