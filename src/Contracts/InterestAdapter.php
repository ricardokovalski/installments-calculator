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
     * @param $totalCapital
     * @return mixed
     */
    public function resetTotalCapital($totalCapital);

    /**
     * @param $interestValue
     * @return mixed
     */
    public function resetInterestValue($interestValue);

    /**
     * @return mixed
     */
    public function getInterestValue();

    /**
     * @return mixed
     */
    public function getInterestRates();

    /**
     * @return mixed
     */
    public function getTotalCapital();

    /**
     * @param $installmentNumber
     * @return mixed
     */
    public function getInterestByInstallmentNumber($installmentNumber);
}
