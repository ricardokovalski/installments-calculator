<?php

namespace Moguzz\Contracts;

/**
 * Interface Factory
 * @package Moguzz\Contracts
 */
interface Factory
{
    public function create($valueCalculated, $numberInstallment, $addedValue);
}