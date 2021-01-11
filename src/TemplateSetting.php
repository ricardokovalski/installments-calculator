<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\Currency;
use RicardoKovalski\InstallmentsCalculator\Contracts\Template;
use RicardoKovalski\InstallmentsCalculator\Currencies\Types\Real;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MaximumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MinimumNumberInstallmentException;

/**
 * Class TemplateSetting
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class TemplateSetting implements Template
{
    const NUMBER_MAX_INSTALLMENT = 12;
    const LIMIT_VALUE_INSTALLMENT = 5.00;

    /**
     * @var Currency $currency
     */
    private $currency;

    /**
     * @var boolean $limitInstallments
     */
    private $limitInstallments;

    /**
     * @var integer $numberMaxInstallments
     */
    private $numberMaxInstallments;

    /**
     * @var float $limitValueInstallment
     */
    private $limitValueInstallment;

    /**
     * TemplateSetting constructor.
     */
    public function __construct()
    {
        $this->currency = new Real();
        $this->limitInstallments = true;
        $this->numberMaxInstallments = self::NUMBER_MAX_INSTALLMENT;
        $this->limitValueInstallment = self::LIMIT_VALUE_INSTALLMENT;
    }

    /**
     * @return Currency|Real
     */
    public function currency()
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function resetCurrency(Currency $currency)
    {
        $this->currency = $currency;
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
