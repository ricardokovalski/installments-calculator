<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\InstallmentsCalculator\Contracts\Adapter;
use RicardoKovalski\InstallmentsCalculator\InterestFactory;
use RicardoKovalski\InterestCalculation\Contracts\Interest;

/**
 * Class InterestAdapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 */
final class InterestAdapter implements Adapter
{
    use InterestFactory;

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

    /*public function appendInterestValue($interestValue)
    {
        $this->interest->appendInterestValue($interestValue);
        return $this;
    }*/

    public function appendTotalCapital($totalCapital)
    {
        $this->interest->appendTotalCapital($totalCapital);
        return $this;
    }

    public function resetTotalCapital($totalCapital)
    {
        $this->interest->resetTotalCapital($totalCapital);
        return $this;
    }

    /*public function resetInterestValue($interestValue)
    {
        $this->interest->resetInterestValue($interestValue);
        return $this;
    }*/

    /*public function getInterestValue()
    {
        return $this->interest->getInterestValue();
    }*/

    /*public function getInterestRates()
    {
        return $this->interest->getInterestRates();
    }*/

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
}
