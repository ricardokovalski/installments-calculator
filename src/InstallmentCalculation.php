<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\Adapter;
use RicardoKovalski\InstallmentsCalculator\Contracts\Calculator as CalculatorContract;
use RicardoKovalski\InstallmentsCalculator\Contracts\Template;

/**
 * Class InstallmentCalculation
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class InstallmentCalculation implements CalculatorContract
{
    /**
     * @var Adapter $interest
     */
    private $interest;

    /**
     * @var Template $template
     */
    private $settings;

    /**
     * @var InstallmentCollection $installmentCollection
     */
    private $installmentCollection;

    /**
     * CalculatorInstallments constructor.
     *
     * @param Adapter $interest
     */
    public function __construct(Adapter $interest)
    {
        $this->interest = $interest;
        $this->settings = new InstallmentCalculationConfig();
        $this->installmentCollection = new InstallmentCollection();
    }

    /**
     * @param Template $settings
     * @return $this
     */
    public function resetTemplateConfig(Template $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @param Adapter $interestAdapter
     * @return $this
     */
    public function resetAdapterInterest(Adapter $interestAdapter)
    {
        $this->interest = $interestAdapter;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        foreach (range(1, $this->settings->getNumberMaxInstallments()) as $installmentNumber) {

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
        return $this->settings->installmentIsLimited() && $valueInstallmentCalculated < $this->settings->getLimitValueInstallment();
    }

    /**
     * @return InstallmentCollection
     */
    public function getCollection()
    {
        return $this->installmentCollection;
    }
}
