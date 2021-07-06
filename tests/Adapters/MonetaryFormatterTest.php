<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

class MonetaryFormatterTest extends TestCase
{
    /**
     * @dataProvider providerFormatterDecimal
     * @param $valueFormatted
     * @param $valueOriginal
     */
    public function testAssertEqualsValueFormatterDecimal($valueFormatted, $valueOriginal)
    {
        $decimalFormatter = MonetaryFormatter::toDecimal(MonetaryFormatterConfig::BRL(Locale::PT_BR));
        $this->assertEquals($valueFormatted, $decimalFormatter->format($valueOriginal));
    }

    /**
     * @return array
     */
    public function providerFormatterDecimal()
    {
        return [
            [0.60, 0.60],
            [1.00, 1.00],
            [25.70, 25.70],
            [167.25, 167.25],
            [2456.68, 2456.68],
            [15894.23, 15894.23],
            [300498.52, 300498.52],
        ];
    }

    /**
     * @dataProvider providerFormatterDecimalIntl
     * @param $valueFormatted
     * @param $valueOriginal
     */
    public function testAssertEqualsValueFormattedIntlDecimal($valueFormatted, $valueOriginal)
    {
        $decimalIntlFormatter = MonetaryFormatter::toIntlDecimal(MonetaryFormatterConfig::BRL(Locale::PT_BR));
        $this->assertEquals($valueFormatted, $decimalIntlFormatter->format($valueOriginal));
    }

    /**
     * @return array
     */
    public function providerFormatterDecimalIntl()
    {
        return [
            ['0,50', 0.50],
            ['2,45', 2.45],
            ['37,85', 37.85],
            ['480,60', 480.60],
            ['5.870,63', 5870.63],
            ['60.745,99', 60745.99],
            ['706.150,80', 706150.80],
        ];
    }

    /**
     * @dataProvider providerFormatterCurrencyIntl
     * @param $valueFormatted
     * @param $valueOriginal
     */
    public function testAssertEqualsValueFormattedIntlCurrency($valueFormatted, $valueOriginal)
    {
        $currencyIntlFormatter = MonetaryFormatter::toIntlCurrency(MonetaryFormatterConfig::USD(Locale::EN_US));
        $this->assertEquals($valueFormatted, $currencyIntlFormatter->format($valueOriginal));
    }

    /**
     * @return array
     */
    public function providerFormatterCurrencyIntl()
    {
        return [
            ['$0.65', 0.65],
            ['$3.68', 3.68],
            ['$40.75', 40.75],
            ['$516.86', 516.86],
            ['$6,958.93', 6958.93],
            ['$71,069.04', 71069.04],
            ['$821,170.11', 821170.11],
        ];
    }
}
