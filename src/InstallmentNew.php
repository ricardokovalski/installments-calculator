<?php

namespace RicardoKovalski\InstallmentsCalculator;

final class InstallmentNew
{
    /**
     * @var float $valueCalculated
     */
    private $valueCalculated;

    /**
     * @var int $numberInstallment
     */
    private $numberInstallment;

    /**
     * @var float $addedValue
     */
    private $addedValue;

    /**
     * @var float $originalValue
     */
    private $originalValue;

    /**
     * Installment constructor.
     *
     * @param $valueCalculated
     * @param $addedValue
     * @param $numberInstallment
     */
    public function __construct($valueCalculated, $addedValue, $numberInstallment)
    {
        $this->valueCalculated = $valueCalculated;
        $this->addedValue = $addedValue;
        $this->numberInstallment = $numberInstallment;
        $this->originalValue = $this->makeOriginalValue();
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

    /**
     * @return float
     */
    private function makeOriginalValue()
    {
        return $this->getValueCalculated() * $this->getNumberInstallment();
    }
}
