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
     * @var Money $valueCalculated
     */
    private $valueCalculated;

    /**
     * @var int $numberInstallment
     */
    private $numberInstallment;

    /**
     * @var Money $addedValue
     */
    private $addedValue;

    /**
     * @var Money $originalValue
     */
    private $originalValue;

    /**
     * Installment constructor.
     *
     * @param Money $valueCalculated
     * @param Money $addedValue
     * @param $numberInstallment
     */
    public function __construct(Money $valueCalculated, Money $addedValue, $numberInstallment)
    {
        $this->valueCalculated = $valueCalculated;
        $this->addedValue = $addedValue;
        $this->numberInstallment = $numberInstallment;
        $this->originalValue = $this->makeOriginalValue();
    }

    /**
     * @return Money
     */
    public function getValueCalculated()
    {
        return $this->valueCalculated;
    }

    /**
     * @return int
     */
    public function getNumberInstallment()
    {
        return $this->numberInstallment;
    }

    /**
     * @return Money
     */
    public function getAddedValue()
    {
        return $this->addedValue;
    }

    /**
     * @return Money
     */
    public function getOriginalValue()
    {
        return $this->originalValue;
    }

    /**
     * @return Money
     */
    private function makeOriginalValue()
    {
        return new Money($this->getValueCalculated()->getAmount() * $this->getNumberInstallment(), $this->getValueCalculated()->getCurrency());
    }
}