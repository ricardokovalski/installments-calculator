<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Template
 *
 * @package Moguzz\Contracts
 */
interface Template
{
    public function resetNumberMaxInstallments($numberMaxInstallments = 1);

    public function getNumberMaxInstallments();

    public function installmentIsLimited();

    public function resetLimitInstallments($limitInstallments = true);

    public function resetLimitValueInstallment($limitValueInstallment = 0);

    public function appendLimitValueInstallment($limitValueInstallment = 1);

    public function getLimitValueInstallment();
}
