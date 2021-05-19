<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface MonetaryFormatterConfigContract
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface MonetaryFormatterConfigContract
{
    /**
     * @param $isoCode
     * @return mixed
     */
    public function resetCurrencyIsoCode($isoCode);

    /**
     * @return mixed
     */
    public function getCurrencyIsoCode();

    /**
     * @param $locale
     * @return mixed
     */
    public function resetLocale($locale);

    /**
     * @return mixed
     */
    public function getLocale();
}
