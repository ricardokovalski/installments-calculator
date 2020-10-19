<?php

namespace Moguzz\Entities;

use Moguzz\Contracts\Currency;
use Moguzz\Currencies\Real;

/**
 * Class Money
 *
 * @package Moguzz\Entities
 */
final class Money
{
    /**
     * @var float $amount
     */
    private $amount;

    /**
     * @var Currency $currency
     */
    private $currency;

    /**
     * Money constructor.
     *
     * @param $amount
     * @param Currency|null $currency
     */
    public function __construct($amount, Currency $currency = null)
    {
        $this->amount = $amount;
        $this->currency = $currency ?: new Real();
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return (float) $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function formatter()
    {
        $formattedValue = number_format(
            $this->getAmount(),
            $this->getCurrency()->getDecimals(),
            $this->getCurrency()->getDecPoint(),
            $this->getCurrency()->getThousandsSep()
        );

        return sprintf("%s %s", $this->getCurrency()->getPrefix(), $formattedValue);
    }
}