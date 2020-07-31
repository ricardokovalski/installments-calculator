<?php

namespace Moguzz\Currencies;

use Moguzz\Contracts\Currency;

/**
 * Class Real
 * @package Moguzz\Currencies
 */
final class Real implements Currency
{
    /**
     * @var string $prefix
     */
    private $prefix = "R$";

    /**
     * @var int $decimals
     */
    private $decimals;

    /**
     * @var string $decPoint
     */
    private $decPoint;

    /**
     * @var string $thousandsSep
     */
    private $thousandsSep;

    /**
     * Dollar constructor.
     * @param int $decimals
     */
    public function __construct($decimals = 2)
    {
        $this->decimals = $decimals;
        $this->decPoint = ",";
        $this->thousandsSep = ".";
    }

    /**
     * @param $amount
     * @return string
     */
    public function formatter($amount)
    {
        $formattedValue = number_format($amount, $this->decimals, $this->decPoint, $this->thousandsSep);
        return sprintf("%s %s", $this->prefix, $formattedValue);
    }
}