<?php

namespace Moguzz\Interest;

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
     * @return float|int
     */
    final function getInterestValue()
    {
        return $this->interestValue;
    }
}