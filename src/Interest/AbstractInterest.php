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
    private $valueInterest;

    /**
     * AbstractInterest constructor.
     * @param $valueInterest
     */
    public function __construct($valueInterest)
    {
        $this->valueInterest = $valueInterest > 0.00 ? $valueInterest / 100 : 0.00;
    }

    /**
     * @return float|int
     */
    final function getValueInterest()
    {
        return $this->valueInterest;
    }
}