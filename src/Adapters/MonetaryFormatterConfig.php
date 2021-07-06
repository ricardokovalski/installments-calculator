<?php

namespace RicardoKovalski\InstallmentsCalculator\Adapters;

use RicardoKovalski\MoneyFormatter\Formatters\BaseFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterConfigContract;

/**
 * Class MonetaryFormatterConfig
 *
 * @package RicardoKovalski\InstallmentsCalculator\Adapters
 *
 * @method static MonetaryFormatterConfig BRL(string $locale)
 * @method static MonetaryFormatterConfig USD(string $locale)
 */
final class MonetaryFormatterConfig implements MonetaryFormatterConfigContract
{
    /**
     * @var BaseFormatterConfig $adapter
     */
    private $adapter;

    /**
     * BaseFormatterAdapter constructor.
     *
     * @param $isoCode
     * @param $locale
     */
    public function __construct($isoCode, $locale)
    {
        $this->adapter = new BaseFormatterConfig($isoCode, $locale);
    }

    /**
     * @param $isoCode
     * @return $this
     */
    public function resetCurrencyIsoCode($isoCode)
    {
        $this->adapter->resetCurrencyIsoCode($isoCode);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyIsoCode()
    {
        return $this->adapter->getCurrencyIsoCode();
    }

    /**
     * @param $locale
     * @return $this
     */
    public function resetLocale($locale)
    {
        $this->adapter->resetLocale($locale);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->adapter->getLocale();
    }

    /**
     * @param $fractionDigits
     * @return $this
     */
    public function resetFractionDigits($fractionDigits)
    {
        $this->adapter->resetFractionDigits($fractionDigits);
        return $this;
    }

    /**
     * @return int
     */
    public function getFractionDigits()
    {
        return $this->adapter->getFractionDigits();
    }

    /**
     * @return BaseFormatterConfig
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param $method
     * @param $arguments
     * @return MonetaryFormatterConfig
     */
    public static function __callStatic($method, $arguments)
    {
        return new self($method, $arguments[0]);
    }
}
