<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface MonetaryFormatterContract
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface MonetaryFormatterContract
{
    /**
     * @param $value
     * @return mixed
     */
    public function format($value);
}
