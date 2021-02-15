<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\Template;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MaximumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MinimumNumberInstallmentException;

/**
 * Class TemplateSetting
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class InstallmentCalculationConfig implements Template
{
    const LIMIT_VALUE_INSTALLMENT = 5.00;
    const NUMBER_MAX_INSTALLMENT = 12;

    /**
     * @var boolean $limitInstallments
     */
    private $limitInstallments;

    /**
     * @var float $limitValueInstallment
     */
    private $limitValueInstallment;

    /**
     * @var integer $numberMaxInstallments
     */
    private $numberMaxInstallments;

    /**
     * TemplateSetting constructor.
     */
    public function __construct()
    {
        $this->limitInstallments = true;
        $this->limitValueInstallment = self::LIMIT_VALUE_INSTALLMENT;
        $this->numberMaxInstallments = self::NUMBER_MAX_INSTALLMENT;
    }

    /**
     * @param $numberMaxInstallments
     * @return $this
     */
    public function resetNumberMaxInstallments($numberMaxInstallments = 1)
    {
        $this->verifyNumberInstallments($numberMaxInstallments);

        $this->numberMaxInstallments = $numberMaxInstallments;
    }

    /**
     * @return int
     */
    public function getNumberMaxInstallments()
    {
        return $this->numberMaxInstallments;
    }

    /**
     * @return bool
     */
    public function installmentIsLimited()
    {
        return (bool) $this->limitInstallments;
    }

    /**
     * @param bool $limitInstallments
     */
    public function resetLimitInstallments($limitInstallments = true)
    {
        $this->limitInstallments = $limitInstallments;
    }

    /**
     * @param $limitValueInstallment
     */
    public function resetLimitValueInstallment($limitValueInstallment = 0)
    {
        $this->limitValueInstallment = $limitValueInstallment;
    }

    /**
     * @param $limitValueInstallment
     */
    public function appendLimitValueInstallment($limitValueInstallment = 1)
    {
        $this->limitValueInstallment += $limitValueInstallment;
    }

    /**
     * @return float
     */
    public function getLimitValueInstallment()
    {
        return $this->limitValueInstallment;
    }

    /**
     * @param $number
     * @return bool
     */
    private function verifyNumberInstallments($number)
    {
        if ($number < 1) {
            throw new MinimumNumberInstallmentException();
        }

        if ($number > 12) {
            throw new MaximumNumberInstallmentException();
        }

        return true;
    }
}
