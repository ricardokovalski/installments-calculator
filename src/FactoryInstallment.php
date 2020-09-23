<?php

namespace Moguzz;

use Moguzz\Contracts\Factory;

/**
 * Class FactoryInstallment
 * @package Moguzz
 */
class FactoryInstallment implements Factory
{
    /**
     * @param $valueCalculated
     * @param $numberInstallment
     * @param $addedValue
     * @return Installment
     */
    public function create($valueCalculated, $numberInstallment, $addedValue)
    {
        return new Installment($valueCalculated, $numberInstallment, $addedValue);
    }
}