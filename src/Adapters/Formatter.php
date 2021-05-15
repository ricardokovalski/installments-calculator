<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\CurrencyFormatter\Formatters\Types\DecimalFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlCurrencyFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlDecimalFormatter;

/**
 * Class BaseFormatterAdapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 *
 * @method static Formatter toIntlCurrency(FormatterConfig $formatterConfig)
 * @method static Formatter toIntlDecimal(FormatterConfig $formatterConfig)
 * @method static Formatter toDecimal(FormatterConfig $formatterConfig)
 */
class Formatter
{
    const toIntlCurrency = 'toIntlCurrency';
    const toIntlDecimal = 'toIntlDecimal';

    private $adapter;

    public function __construct(FormatterConfig $formatterConfig, $method)
    {
        $this->adapter = new $method($formatterConfig->getAdapter());
    }

    public function format($value)
    {
        return $this->adapter->format($value);
    }

    public static function __callStatic($method, $arguments)
    {
        return new self($arguments[0], self::getCurrentClass($method));
    }

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
