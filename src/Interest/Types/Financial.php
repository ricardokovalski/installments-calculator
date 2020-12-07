<?php

namespace Moguzz\Interest\Types;

use Moguzz\Contracts\Interest;

/**
 * Class Financial
 *
 * @package Moguzz\Interest\Types
 */
final class Financial extends AbstractInterest implements Interest
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
