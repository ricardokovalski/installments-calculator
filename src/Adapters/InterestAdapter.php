<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\InstallmentsCalculator\Contracts\Adapter;
use RicardoKovalski\InterestCalculation\Contracts\Interest;

/**
 * Class InterestAdapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 */
class InterestAdapter implements Adapter
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
     * @param $numberInstallment
     * @return mixed
     */
    public function getValueCalculatedByInstallment($numberInstallment)
    {
        return $this->interest->getValueCalculatedByInstallment($numberInstallment);
    }
}
