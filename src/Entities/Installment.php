<?php

namespace Moguzz\Entities;

/**
 * Class Installment
 *
 * @package Moguzz\Entities
 */
final class Installment
{
    /**
     * @var Money $valueCalculated
     */
    public $valueCalculated;

    /**
     * @var int $numberInstallment
     */
    public $numberInstallment;

    /**
     * @var Money $addedValue
     */
    public $addedValue;

    /**
     * @var Money $originalValue
     */
    public $originalValue;

    /**
     * Installment constructor.
     *
     * @param Money $valueCalculated
     * @param $numberInstallment
     * @param Money $addedValue
     */
    public function __construct(Money $valueCalculated, $numberInstallment, Money $addedValue)
    {
        $this->valueCalculated = $valueCalculated;
        $this->numberInstallment = $numberInstallment;
        $this->addedValue = $addedValue;
        $this->originalValue = new Money($this->getValueCalculated()->getAmount() * $this->getNumberInstallment());
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
}