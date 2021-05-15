<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\InstallmentsCalculator\Contracts\InterestAdapter;
//use RicardoKovalski\InstallmentsCalculator\InterestFactory;
use RicardoKovalski\InterestCalculation\Contracts\Interest;

/**
 * Class InterestCalculation
 *
 * @method static InterestCalculation Financial(float $interestValue)
 * @method static InterestCalculation Compound(float $interestValue)
 * @method static InterestCalculation Simple(float $interestValue)
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 */
final class InterestCalculation implements InterestAdapter
{
    /**
     * @var Interest $interest
     */
    private $interest;

    /**
     * InterestAdapter constructor.
     *
     * @param Interest $interest
     */
    public function __construct(Interest $interest)
    {
        $this->interest = $interest;
    }

    /**
     * @param $interestValue
     * @return $this
     */
    public function appendInterestValue($interestValue)
    {
        $this->interest->appendInterestValue($interestValue);
        return $this;
    }

    /**
     * @param $totalCapital
     * @return $this
     */
    public function appendTotalCapital($totalCapital)
    {
        $this->interest->appendTotalCapital($totalCapital);
        return $this;
    }

    /**
     * @param $totalCapital
     * @return $this
     */
    public function resetTotalCapital($totalCapital)
    {
        $this->interest->resetTotalCapital($totalCapital);
        return $this;
    }

    /**
     * @param $interestValue
     * @return $this
     */
    public function resetInterestValue($interestValue)
    {
        $this->interest->resetInterestValue($interestValue);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterestValue()
    {
        return $this->interest->getInterestValue();
    }

    /**
     * @return mixed
     */
    public function getInterestRates()
    {
        return $this->interest->getInterestRates();
    }

    /**
     * @return mixed
     */
    public function getTotalCapital()
    {
        return $this->interest->getTotalCapital();
    }

    /**
     * @param $installmentNumber
     * @return mixed
     */
    public function getInterestByInstallmentNumber($installmentNumber)
    {
        return $this->interest->getValueCalculatedByInstallment($installmentNumber);
    }

    /**
     * @param $method
     * @param $arguments
     * @return InterestCalculation
     */
    public static function __callStatic($method, $arguments)
    {
        $concreteClassInterest = "RicardoKovalski\\InterestCalculation\\Types\\{$method}";

        return new InterestCalculation(new $concreteClassInterest(current($arguments)?:0.00));
    }
}
