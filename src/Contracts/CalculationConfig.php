<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface CalculationConfig
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface CalculationConfig
{
    /**
     * @param InterestAdapter $interest
     * @return mixed
     */
    public function resetInterest(InterestAdapter $interest);

    /**
     * @return InterestAdapter
     */
    public function getInterest();

    /**
     * @param int $numberMaxInstallments
     * @return mixed
     */
    public function resetNumberMaxInstallments($numberMaxInstallments = 1);

    /**
     * @return mixed
     */
    public function getNumberMaxInstallments();

    /**
     * @return mixed
     */
    public function installmentIsLimited();

    /**
     * @param bool $limitInstallments
     * @return mixed
     */
    public function resetLimitInstallments($limitInstallments = true);

    /**
     * @param int $limitValueInstallment
     * @return mixed
     */
    public function resetLimitValueInstallment($limitValueInstallment = 0);

    /**
     * @param int $limitValueInstallment
     * @return mixed
     */
    public function appendLimitValueInstallment($limitValueInstallment = 1);

    /**
     * @return mixed
     */
    public function getLimitValueInstallment();
}
