<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\IsoCodes;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

class MonetaryFormatterConfigTest extends TestCase
{
    /**
     * @var MonetaryFormatterConfig
     */
    private $formatterConfig;

    public function setUp()
    {
        $this->formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);
    }

    public function testAssertEqualsGetCurrencyIsoCode()
    {
        $this->assertEquals(IsoCodes::BRL, $this->formatterConfig->getCurrencyIsoCode());
    }

    public function testAssertEqualsResetCurrencyIsoCode()
    {
        $this->formatterConfig->resetCurrencyIsoCode(IsoCodes::USD);
        $this->assertEquals(IsoCodes::USD, $this->formatterConfig->getCurrencyIsoCode());
    }

    public function testAssertEqualsGetLocale()
    {
        $this->assertEquals(Locale::PT_BR, $this->formatterConfig->getLocale());
    }

    public function testAssertEqualsResetLocale()
    {
        $this->formatterConfig->resetLocale(Locale::EN_US);
        $this->assertEquals(Locale::EN_US, $this->formatterConfig->getLocale());
    }

    public function testAssertEqualsGetFractionalDigits()
    {
        $this->assertEquals(2, $this->formatterConfig->getFractionDigits());
    }

    public function testAssertEqualsResetFractionalDigits()
    {
        $this->formatterConfig->resetFractionDigits(3);
        $this->assertEquals(3, $this->formatterConfig->getFractionDigits());
    }

    public function testAssertEqualsGetAdapter()
    {
        $this->assertInstanceOf(
            \RicardoKovalski\MoneyFormatter\Formatters\Contracts\FormatterConfig::class,
            $this->formatterConfig->getAdapter()
        );
    }
}
