<?php

namespace RicardoKovalski\InstallmentsCalculator\Currencies\Types;

use RicardoKovalski\InstallmentsCalculator\Contracts\Currency;

/**
 * Class Dollar
 *
 * @package RicardoKovalski\InstallmentsCalculator\Currencies\Types
 */
final class Dollar extends CompositeCurrency implements Currency
{
    /**
     * Dollar constructor.
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
        return '$';
    }

    /**
     * @return string
     */
    public function decPoint()
    {
        return '.';
    }

    /**
     * @return string
     */
    public function thousandsSep()
    {
        return ',';
    }
}
