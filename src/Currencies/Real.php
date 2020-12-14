<?php

namespace Moguzz\Currencies;

use Moguzz\Contracts\Currency;

/**
 * Class Real
 *
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
     * Real constructor.
     *
     * @param int $decimals
     */
    public function __construct($decimals = 2)
    {
        $this->decimals = $decimals;
        $this->decPoint = ",";
        $this->thousandsSep = ".";
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return int
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * @return string
     */
    public function getDecPoint()
    {
        return $this->decPoint;
    }

    /**
     * @return string
     */
    public function getThousandsSep()
    {
        return $this->thousandsSep;
    }
}