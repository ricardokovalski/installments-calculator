<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;

/**
 * Trait Factory
 *
 * @method static InterestCalculation Financial(float $interestValue)
 * @method static InterestCalculation Compound(float $interestValue)
 * @method static InterestCalculation Simple(float $interestValue)
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
trait InterestFactory
{
    /**
     * @param $method
     * @param $arguments
     * @return InterestCalculation
     */
    public static function __callStatic($method, $arguments)
    {
        $concreteClassInterest = "RicardoKovalski\\InterestCalculation\\Types\\{$method}";

        return new InterestCalculation(new $concreteClassInterest(current($arguments)?:0.00));
    }
}
