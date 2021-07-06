<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\CalculationConfig;

/**
 * Class InstallmentCalculation
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class InstallmentCalculation
{
    /**
     * @var CalculationConfig $calculationConfig
     */
    private $calculationConfig;

    /**
     * @var InstallmentCollection $installmentCollection
     */
    private $installmentCollection;

    /**
     * @var float
     */
    private $totalPurchase;

    /**
     * CalculatorInstallments constructor.
     */
    public function __construct(CalculationConfig $installmentCalculationConfig)
    {
        $this->calculationConfig = $installmentCalculationConfig;
        $this->installmentCollection = new InstallmentCollection();
        $this->totalPurchase = 0.00;
    }

    /**
     * @param $totalPurchase
     * @return $this
     */
    public function appendTotalPurchase($totalPurchase)
    {
        $this->totalPurchase += $totalPurchase;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        if ($this->installmentCollection->count() > 1) {
            $this->installmentCollection->resetInstallments();
        }

        $interest = $this->calculationConfig->getInterest();
        $interest->resetTotalCapital($this->getTotalPurchase());

        foreach (range(1, $this->calculationConfig->getNumberMaxInstallments()) as $installmentNumber) {
            $installmentValue = $interest->getInterestByInstallmentNumber($installmentNumber) / $installmentNumber;

            if ($this->installmentValueIsLessThanLimitValue($installmentValue)) {
                break;
            }

            $this->installmentCollection->appendInstallment(
                new Installment($installmentValue, $this->getInterestValueAddInInstallmentNumber($installmentNumber), $installmentNumber)
            );
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPurchase()
    {
        return $this->totalPurchase;
    }

    /**
     * @return InstallmentCollection
     */
    public function getCollection()
    {
        return $this->installmentCollection;
    }

    /**
     * @param $valueInstallmentCalculated
     * @return bool
     */
    private function installmentValueIsLessThanLimitValue($valueInstallmentCalculated)
    {
        return $this->calculationConfig->installmentIsLimited() && $valueInstallmentCalculated < $this->calculationConfig->getLimitValueInstallment();
    }

    /**
     * @param $installmentNumber
     * @return mixed
     */
    private function getInterestValueAddInInstallmentNumber($installmentNumber)
    {
        $interest = $this->calculationConfig->getInterest();
        return $interest->getInterestByInstallmentNumber($installmentNumber) - $interest->getTotalCapital();
    }
}
