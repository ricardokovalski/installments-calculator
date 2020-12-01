<?php

namespace Moguzz;

use Moguzz\Contracts\Interest;
use Moguzz\Entities\Installment;
use Moguzz\Entities\Money;

/**
 * Class Calculator
 *
 * @package Moguzz
 */
class Calculator
{
    /**
     * @var float $totalPurchase
     */
    private $totalPurchase;

    /**
     * @var TemplateSetting $template
     */
    private $template;

    /**
     * @var Interest $interest
     */
    private $interest;

    /**
     * @var InstallmentCollection $installmentCollection
     */
    private $installmentCollection;

    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        $this->totalPurchase = 0.00;
        $this->template = new TemplateSetting();
        $this->installmentCollection = new InstallmentCollection();
    }

    /**
     * @param float $totalPurchase
     * @return $this
     */
    public function appendTotalPurchase($totalPurchase)
    {
        $this->totalPurchase += $totalPurchase;
        return $this;
    }

    /**
     * @param float $totalPurchase
     * @return $this
     */
    public function resetTotalPurchase($totalPurchase = 0.00)
    {
        $this->totalPurchase = $totalPurchase;
        return $this;
    }

    /**
     * @param TemplateSetting $template
     * @return $this
     */
    public function loadTemplateSetting(TemplateSetting $template)
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
        $this->interest->appendTotalCapital($this->getTotalPurchase());

        foreach (range(1, $this->template()->getNumberMaxInstallments()) as $numberInstallment) {

            if ($this->installmentValueIsLessThanLimitValue($this->interest->getValueCalculated($numberInstallment) / $numberInstallment)) {
                break;
            }

            $installment = new Installment(
                new Money($this->interest->getValueCalculated($numberInstallment) / $numberInstallment, $this->template()->getCurrency()),
                new Money($this->interest->getValueCalculated($numberInstallment) - $this->totalPurchase, $this->template()->getCurrency()),
                $numberInstallment
            );

            $this->installmentCollection->appendInstallment($installment);
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