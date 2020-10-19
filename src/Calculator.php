<?php

namespace Moguzz;

use Moguzz\Contracts\Currency;
use Moguzz\Contracts\Interest;
use Moguzz\Entities\Installment;
use Moguzz\Entities\Money;

/**
 * Class Calculator
 * @package Moguzz
 */
class Calculator
{
    use FormattingTrait;

    /**
     * @var Interest $interest
     */
    private $interest;

    /**
     * @var Currency $currency
     */
    private $currency;

    /**
     * @var float $totalPurchase
     */
    private $totalPurchase;

    /**
     * @var TemplateSetting $template
     */
    private $template;

    /**
     * @var InstallmentCollection
     */
    private $installmentCollection;

    /**
     * Calculator constructor.
     * @param Interest $interest
     */
    public function __construct(Interest $interest)
    {
        $this->interest = $interest;
        $this->totalPurchase = (new Money(0.00))->getAmount();
        $this->template = new TemplateSetting();
        $this->installmentCollection = new InstallmentCollection();
    }

    /**
     * @param Money $totalPurchase
     * @return $this
     */
    public function appendTotalPurchase(Money $totalPurchase)
    {
        $this->totalPurchase += $totalPurchase->getAmount();
        return $this;
    }

    /**
     * @param TemplateSetting $template
     * @return $this
     */
    public function setTemplateSetting(TemplateSetting $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return $this
     */
    public function calculateInstallments()
    {
        foreach (range(1, $this->template()->getNumberMaxInstallments()) as $numberInstallment) {

            $originalValueInstallment = $this->interest->getValueInstallmentCalculated($this->totalPurchase, $numberInstallment);

            $valueCalculated = new Money($originalValueInstallment / $numberInstallment);

            if ($this->installmentValueIsLessThanLimitValue($valueCalculated->getAmount())) {
                break;
            }

            $addedValue = new Money($originalValueInstallment - $this->totalPurchase);

            $this->installmentCollection->appendInstallment(
                new Installment($valueCalculated, $numberInstallment, $addedValue)
            );
        }

        return $this;
    }

    /**
     * @param $valueInstallmentCalculated
     * @return bool
     */
    private function installmentValueIsLessThanLimitValue($valueInstallmentCalculated)
    {
        return $this->template()->isLimitInstallments() &&
            $valueInstallmentCalculated < $this->template()->getLimitValueInstallment();
    }

    /**
     * @return float
     */
    public function getTotalPurchase()
    {
        return $this->totalPurchase;
    }

    /**
     * @return TemplateSetting
     */
    public function template()
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getCollectionInstallments()
    {
        return $this->installmentCollection;
    }
}