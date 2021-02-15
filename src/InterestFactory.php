<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestAdapter;

/**
 * Trait Factory
 *
 * @method static InterestAdapter Financial(float $interestValue)
 * @method static InterestAdapter Compound(float $interestValue)
 * @method static InterestAdapter Simple(float $interestValue)
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
trait InterestFactory
{
    /**
     * @param $method
     * @param $arguments
     * @return InterestAdapter
     */
    public static function __callStatic($method, $arguments)
    {
        $concreteClassInterest = "RicardoKovalski\\InterestCalculation\\Types\\{$method}";

        return new InterestAdapter(new $concreteClassInterest(current($arguments)?:0.00));
    }
}
