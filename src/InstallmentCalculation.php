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
     * @var Adapter $interestAdapter
     */
    private $interestAdapter;

    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var InstallmentCollection $installmentCollection
     */
    private $installmentCollection;

    /**
     * CalculatorInstallments constructor.
     *
     * @param Adapter $interestAdapter
     * @param Template|null $template
     */
    public function __construct(Adapter $interestAdapter, Template $template = null)
    {
        $this->interestAdapter = $interestAdapter;
        $this->template = $template ?: new TemplateSetting();
        $this->installmentCollection = new InstallmentCollection();
    }

    /**
     * @param Template $template
     * @return $this
     */
    public function applySetting(Template $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @param Adapter $interestAdapter
     * @return $this
     */
    public function applyInterest(Adapter $interestAdapter)
    {
        $this->interestAdapter = $interestAdapter;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        foreach (range(1, $this->template->getNumberMaxInstallments()) as $numberInstallment) {
            if ($this->installmentValueIsLessThanLimitValue($this->getValueCalculated($numberInstallment))) {
                break;
            }

            $this->installmentCollection->appendInstallment($this->createInstallment($numberInstallment));
        }

        return $this;
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
        return $this->template->installmentIsLimited() &&
            $valueInstallmentCalculated < $this->template->getLimitValueInstallment();
    }

    /**
     * @param $numberInstallment
     * @return Installment
     */
    private function createInstallment($numberInstallment)
    {
        return new Installment(
            new Money($this->getValueCalculated($numberInstallment), $this->template->currency()),
            new Money($this->interestAdapter->getValueCalculatedByInstallment($numberInstallment) - $this->interestAdapter->getTotalCapital(), $this->template->currency()),
            $numberInstallment
        );
    }

    /**
     * @param $numberInstallment
     * @return float|int
     */
    private function getValueCalculated($numberInstallment)
    {
        return $this->interestAdapter->getValueCalculatedByInstallment($numberInstallment) / $numberInstallment;
    }
}
