<?php

namespace RicardoKovalski\InstallmentsCalculator\Interest\Types;

use RicardoKovalski\InstallmentsCalculator\Contracts\Interest;

/**
 * Class Financial
 *
 * @package RicardoKovalski\InstallmentsCalculator\Interest\Types
 */
final class Financial extends CompositeInterest implements Interest
{
    /**
     * Financial constructor.
     *
     * @param float $interestValue
     */
    public function __construct($interestValue = 0.00)
    {
        parent::__construct($interestValue);
    }

    /**
     * @param $numberInstallment
     * @return float|int
     */
    public function getValueCalculatedByInstallment($numberInstallment)
    {
        if ($this->interestValueIsZeroed() || $numberInstallment == 1) {
            return $this->getTotalCapital();
        }

        return $this->getTotalCapital() * $this->getInterestRates() / (1 - pow(1 + $this->getInterestRates(), -$numberInstallment)) * $numberInstallment;
    }
}
