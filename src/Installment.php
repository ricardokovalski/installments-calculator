<?php

namespace Moguzz;

/**
 * Class Installment
 * @package Moguzz
 */
final class Installment
{
    /**
     * @var float $valueCalculated
     */
    public $valueCalculated;

    /**
     * @var int $numberInstallment
     */
    public $numberInstallment;

    /**
     * @var float $addedValue
     */
    public $addedValue;

    /**
     * @var float $originalValue
     */
    public $originalValue;

    /**
     * Installment constructor.
     * @param $valueCalculated
     * @param $numberInstallment
     * @param $addedValue
     */
    public function __construct($valueCalculated, $numberInstallment, $addedValue)
    {
        $this->valueCalculated = $valueCalculated;
        $this->numberInstallment = $numberInstallment;
        $this->addedValue = $addedValue;
        $this->originalValue = $this->valueCalculated * $this->numberInstallment;
    }

    /**
     * @return float
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
     * @return float
     */
    public function getAddedValue()
    {
        return $this->addedValue;
    }

    /**
     * @return float
     */
    public function getOriginalValue()
    {
        return $this->originalValue;
    }
}