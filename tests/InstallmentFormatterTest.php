<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterContract;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;
use RicardoKovalski\InstallmentsCalculator\Enums\Patterns;
use RicardoKovalski\InstallmentsCalculator\Installment;
use RicardoKovalski\InstallmentsCalculator\InstallmentFormatter;

class InstallmentFormatterTest extends TestCase
{
    private $installmentFormatter;

    public function setUp()
    {
        $decimalFormatter = MonetaryFormatter::toDecimal(MonetaryFormatterConfig::BRL(Locale::PT_BR));
        $this->installmentFormatter = new InstallmentFormatter($decimalFormatter);
    }

    public function testGetMonetaryFormatter()
    {
        $this->assertInstanceOf(
            MonetaryFormatterContract::class,
            $this->installmentFormatter->getMonetaryFormatter()
        );
    }

    public function testResetMonetaryFormatter()
    {
        $intlDecimalFormatter = MonetaryFormatter::toIntlDecimal(MonetaryFormatterConfig::BRL(Locale::PT_BR));
        $this->installmentFormatter->resetMonetaryFormatter($intlDecimalFormatter);

        $this->assertInstanceOf(
            MonetaryFormatterContract::class,
            $this->installmentFormatter->getMonetaryFormatter()
        );
    }

    public function testGetPattern()
    {
        $this->assertEquals(Patterns::PATTERN_A, $this->installmentFormatter->getPattern());
    }

    public function testExpectedExceptionIfPatternNotString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->installmentFormatter->resetPattern(1);
    }

    public function testExpectedExceptionIfPatternNotIsType()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->installmentFormatter->resetPattern('xyz');
    }

    public function testResetPattern()
    {
        $this->installmentFormatter->resetPattern(Patterns::PATTERN_B);
        $this->assertEquals(Patterns::PATTERN_B, $this->installmentFormatter->getPattern());
    }

    /**
     * @dataProvider providerInstallmentsFormattedByPatternA
     * @param $formatted
     * @param Installment $installment
     */
    public function testFormattedByPatternA($formatted, Installment $installment)
    {
        $this->assertEquals($formatted, $this->installmentFormatter->format($installment));
    }

    /**
     * @return array[]
     */
    public function providerInstallmentsFormattedByPatternA()
    {
        return [
            ['1 x 450.00', new Installment(450.00, 0, 1)],
            ['2 x 235.14', new Installment(235.14079732992, 20.281594659835, 2)],
            ['3 x 159.06', new Installment(159.05807777209, 27.174233316284, 3)],
            ['4 x 121.03', new Installment(121.03322182922, 34.132887316866, 4)],
            ['5 x 98.23', new Installment(98.231503314593, 41.157516572966, 5)],
        ];
    }

    /**
     * @dataProvider providerInstallmentsFormattedByPatternB
     * @param $formatted
     * @param Installment $installment
     */
    public function testFormattedByPatternB($formatted, Installment $installment)
    {
        $this->installmentFormatter->resetPattern(Patterns::PATTERN_B);
        $this->assertEquals($formatted, $this->installmentFormatter->format($installment));
    }

    /**
     * @return array[]
     */
    public function providerInstallmentsFormattedByPatternB()
    {
        return [
            ['1 x 450.00 (0.00)', new Installment(450.00, 0, 1)],
            ['2 x 235.14 (20.28)', new Installment(235.14079732992, 20.281594659835, 2)],
            ['3 x 159.06 (27.17)', new Installment(159.05807777209, 27.174233316284, 3)],
            ['4 x 121.03 (34.13)', new Installment(121.03322182922, 34.132887316866, 4)],
            ['5 x 98.23 (41.16)', new Installment(98.231503314593, 41.157516572966, 5)],
        ];
    }
}
