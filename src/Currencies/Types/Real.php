<?php

namespace RicardoKovalski\InstallmentsCalculator\Currencies\Types;

use RicardoKovalski\InstallmentsCalculator\Contracts\Currency;

/**
 * Class Real
 *
 * @package RicardoKovalski\InstallmentsCalculator\Currencies\Types
 */
final class Real extends CompositeCurrency implements Currency
{
    /**
     * Real constructor.
     *
     * @param int $decimals
     */
    public function __construct($decimals = 2)
    {
        parent::__construct($decimals);
    }

    /**
     * @return string
     */
    public function prefix()
    {
        return "R$";
    }

    /**
     * @return string
     */
    public function decPoint()
    {
        return ",";
    }

    /**
     * @return string
     */
    public function thousandsSep()
    {
        return ".";
    }
}