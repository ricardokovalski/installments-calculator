<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\InterestAdapter;
use RicardoKovalski\InstallmentsCalculator\Contracts\CalculationConfig;

/**
 * Class InstallmentCalculation
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class InstallmentCalculation
{
    /**
     * @var InterestAdapter $interest
     */
    private $interest;

    /**
     * @var CalculationConfig $calculationConfig
     */
    private $calculationConfig;

    /**
     * @var InstallmentCollection $installmentCollection
     */
    private $installmentCollection;

    /**
     * CalculatorInstallments constructor.
     *
     * @param InterestAdapter $interest
     */
    public function __construct(InterestAdapter $interest)
    {
        $this->interest = $interest;
        $this->calculationConfig = new InstallmentCalculationConfig();
        $this->installmentCollection = new InstallmentCollection();
    }

    /**
     * @param CalculationConfig $calculationConfig
     * @return $this
     */
    public function resetCalculationConfig(CalculationConfig $calculationConfig)
    {
        $this->calculationConfig = $calculationConfig;
        return $this;
    }

    /**
     * @param InterestAdapter $interestAdapter
     * @return $this
     */
    public function resetAdapterInterest(InterestAdapter $interestAdapter)
    {
        $this->interest = $interestAdapter;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        foreach (range(1, $this->calculationConfig->getNumberMaxInstallments()) as $installmentNumber) {

            $installmentValue = $this->interest->getInterestByInstallmentNumber($installmentNumber) / $installmentNumber;

            if ($this->installmentValueIsLessThanLimitValue($installmentValue)) {
                break;
            }

            $installment = new CreateInstallment($this->interest->getInterestByInstallmentNumber($installmentNumber), $this->interest->getTotalCapital(), $installmentNumber);

            $this->installmentCollection->appendInstallment($installment->getInstallment());
        }

        return $this;
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
     * @return InstallmentCollection
     */
    public function getCollection()
    {
        return $this->installmentCollection;
    }
}
