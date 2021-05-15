<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface FormatterAdapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface FormatterAdapter
{
    /**
     * @param $value
     * @return mixed
     */
    public function format($value);
}
