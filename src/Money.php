<?php

namespace Moguzz;

use Moguzz\Contracts\Currency;

/**
 * Class Money
 *
 * @package Moguzz
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
     * @param Currency $currency
     */
    public function __construct($amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
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