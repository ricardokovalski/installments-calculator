<?php

namespace Moguzz;

use Moguzz\Contracts\Currency;
use Moguzz\Contracts\Interest;

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
     * @param Currency $currency
     */
    public function __construct(Interest $interest, Currency $currency)
    {
        $this->interest = $interest;
        $this->currency = $currency;
        $this->totalPurchase = 0.00;
        $this->template = new TemplateSetting();
        $this->installmentCollection = new InstallmentCollection();
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
        $factory = new FactoryInstallment();

        foreach (range(1, $this->template()->getNumberMaxInstallments()) as $numberInstallment) {

            $originalValueInstallment = $this->interest->getValueInstallmentCalculated($this->totalPurchase, $numberInstallment);
            $valueCalculated = $originalValueInstallment / $numberInstallment;

            if ($this->installmentValueIsLessThanLimitValue($valueCalculated)) {
                break;
            }

            $addedValue = $originalValueInstallment - $this->totalPurchase;

            $this->installmentCollection->appendInstallment($factory->create($valueCalculated, $numberInstallment, $addedValue));
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
     * @return mixed
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