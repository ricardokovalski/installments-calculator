<?php

namespace Moguzz\Interest\Types;

use Moguzz\Contracts\Interest;

/**
 * Class Compound
 *
 * @package Moguzz\Interest\Types
 */
final class Compound extends AbstractInterest implements Interest
{
    /**
     * Compound constructor.
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
        if ($this->interestValueIsZeroed()) {
            return $this->getTotalCapital();
        }

        return $this->getTotalCapital() * pow((1 + $this->getInterestRates()), $numberInstallment - 1);
    }
}
