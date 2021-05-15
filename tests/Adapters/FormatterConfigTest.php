<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\FormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\IsoCodes;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

class FormatterConfigTest extends TestCase
{
    /**
     * @var FormatterConfig
     */
    private $formatterConfig;

    public function setUp()
    {
        $this->formatterConfig = FormatterConfig::BRL(Locale::PT_BR);
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

    public function testAssertEqualsGetAdapter()
    {
        $this->assertInstanceOf(
            \RicardoKovalski\CurrencyFormatter\Formatters\Contracts\FormatterConfig::class,
            $this->formatterConfig->getAdapter()
        );
    }
}
