<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\CurrencyFormatter\Formatters\Types\DecimalFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlCurrencyFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlDecimalFormatter;
use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterContract;

/**
 * Class MonetaryFormatter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 *
 * @method static MonetaryFormatter toIntlCurrency(MonetaryFormatterConfig $monetaryFormatterConfig)
 * @method static MonetaryFormatter toIntlDecimal(MonetaryFormatterConfig $monetaryFormatterConfig)
 * @method static MonetaryFormatter toDecimal(MonetaryFormatterConfig $monetaryFormatterConfig)
 */
final class MonetaryFormatter implements MonetaryFormatterContract
{
    const toIntlCurrency = 'toIntlCurrency';
    const toIntlDecimal = 'toIntlDecimal';

    /**
     * @var mixed
     */
    private $adapter;

    /**
     * MonetaryFormatter constructor.
     *
     * @param MonetaryFormatterConfig $monetaryFormatterConfig
     * @param $method
     */
    public function __construct(MonetaryFormatterConfig $monetaryFormatterConfig, $method)
    {
        $this->adapter = new $method($monetaryFormatterConfig->getAdapter());
    }

    /**
     * @param $value
     * @return mixed
     */
    public function format($value)
    {
        return $this->adapter->format($value);
    }

    /**
     * @param $method
     * @param $arguments
     * @return MonetaryFormatter
     */
    public static function __callStatic($method, $arguments)
    {
        return new self($arguments[0], self::getCurrentClass($method));
    }

    /**
     * @param $method
     * @return string
     */
    private static function getCurrentClass($method)
    {
        if (self::toIntlCurrency === $method) {
            return IntlCurrencyFormatter::class;
        }

        if (self::toIntlDecimal === $method) {
            return IntlDecimalFormatter::class;
        }

        return DecimalFormatter::class;
    }
}
