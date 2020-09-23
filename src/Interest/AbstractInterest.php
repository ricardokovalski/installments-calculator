<?php

namespace Moguzz\Interest;

use InvalidArgumentException;

/**
 * Class AbstractInterest
 * @package Moguzz\Interest
 */
abstract class AbstractInterest
{
    /**
     * @var float|int
     */
    private $interestValue;

    /**
     * AbstractInterest constructor.
     * @param $interestValue
     */
    public function __construct($interestValue)
    {
        if (! is_numeric($interestValue)) {
            throw new InvalidArgumentException('Interest value is numeric type.');
        }

        $this->interestValue = $interestValue > 0.00 ? $interestValue / 100 : 0.00;
    }

    /**
     * @return bool
     */
    final function interestValueIsZeroed()
    {
        return $this->interestValue == 0.00;
    }

    /**
     * @return float
     */
    final function getInterestValue()
    {
        return (double) $this->interestValue;
    }
}