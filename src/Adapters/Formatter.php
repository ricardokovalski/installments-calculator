<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\CurrencyFormatter\Formatters\Types\DecimalFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlCurrencyFormatter;
use RicardoKovalski\CurrencyFormatter\Formatters\Types\IntlDecimalFormatter;
use RicardoKovalski\InstallmentsCalculator\Contracts\FormatterAdapter;

/**
 * Class BaseFormatterAdapter
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 *
 * @method static Formatter toIntlCurrency(FormatterConfig $formatterConfig)
 * @method static Formatter toIntlDecimal(FormatterConfig $formatterConfig)
 * @method static Formatter toDecimal(FormatterConfig $formatterConfig)
 */
final class Formatter implements FormatterAdapter
{
    const toIntlCurrency = 'toIntlCurrency';
    const toIntlDecimal = 'toIntlDecimal';

    /**
     * @var mixed
     */
    private $adapter;

    /**
     * Formatter constructor.
     * @param FormatterConfig $formatterConfig
     * @param $method
     */
    public function __construct(FormatterConfig $formatterConfig, $method)
    {
        $this->adapter = new $method($formatterConfig->getAdapter());
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
     * @return Formatter
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
