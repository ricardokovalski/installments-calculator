<?php

namespace Moguzz\Interest\Types;

use Moguzz\Contracts\Interest;

/**
 * Class Simple
 *
 * @package Moguzz\Interest\Types
 */
final class Simple extends AbstractInterest implements Interest
{
    /**
     * Simple constructor.
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

        return $this->getTotalCapital() + ($this->getInterestRates() * $this->getTotalCapital());
    }
}