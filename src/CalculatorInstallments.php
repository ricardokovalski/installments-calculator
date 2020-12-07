<?php

namespace Moguzz;

use Moguzz\Contracts\Calculator as CalculatorContract;
use Moguzz\Contracts\Interest;
use Moguzz\Contracts\Template;
use Moguzz\Entities\Installment;
use Moguzz\Entities\Money;

/**
 * Class CalculatorInstallments
 *
 * @package Moguzz
 */
final class CalculatorInstallments implements CalculatorContract
{
    /**
     * @var Interest $interest
     */
    private $interest;

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
     * @param Interest $interest
     * @param Template|null $template
     */
    public function __construct(Interest $interest, Template $template = null)
    {
        $this->interest = $interest;
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
     * @param Interest $interest
     * @return $this
     */
    public function applyInterest(Interest $interest)
    {
        $this->interest = $interest;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculateInstallments()
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
    public function getCollectionInstallments()
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
            new Money($this->interest->getValueCalculatedByInstallment($numberInstallment) - $this->interest->getTotalCapital(), $this->template->currency()),
            $numberInstallment
        );
    }

    /**
     * @param $numberInstallment
     * @return float|int
     */
    private function getValueCalculated($numberInstallment)
    {
        return $this->interest->getValueCalculatedByInstallment($numberInstallment) / $numberInstallment;
    }
}