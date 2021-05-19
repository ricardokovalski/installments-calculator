<?php

namespace RicardoKovalski\InstallmentsCalculator;

/**
 * Class Installment
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class Installment
{
    /**
     * @var float $valueInstallment
     */
    private $valueInstallment;

    /**
     * @var int $numberInstallment
     */
    private $numberInstallment;

    /**
     * @var float $interestValue
     */
    private $interestValue;

    /**
     * @var float $totalIterest
     */
    private $totalInterest;

    /**
     * Installment constructor.
     *
     * @param $valueInstallment
     * @param $interestValue
     * @param $numberInstallment
     */
    public function __construct($valueInstallment, $interestValue, $numberInstallment)
    {
        $this->valueInstallment = $valueInstallment;
        $this->interestValue = $interestValue;
        $this->numberInstallment = $numberInstallment;
        $this->totalInterest = $this->valueInstallment * $this->numberInstallment;
    }

    /**
     * @return float
     */
    public function getValueInstallment()
    {
        return $this->valueInstallment;
    }

    /**
     * @return int
     */
    public function getNumberInstallment()
    {
        return $this->numberInstallment;
    }

    /**
     * @return float
     */
    public function getInterestValue()
    {
        return $this->interestValue;
    }

    /**
     * @return float
     */
    public function getTotalInterest()
    {
        return $this->totalInterest;
    }

    public function formatter(InstallmentFormatter $formatter)
    {
        return sprintf($formatter->getPattern(), $this->getNumberInstallment(), $formatter->getMonetaryFormatter()->format($this->getValueInstallment()));
    }
}
