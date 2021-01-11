<?php

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Exceptions\InterestValueException;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;

class FinancialTest extends TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InterestValueException::class);
        new Financial('nUm3r0');
    }

    public function testExpectedExceptionWhenAppendInterestValueNotIsNumericType()
    {
        $interest = new Financial(2.20);

        $this->assertEquals(2.20, $interest->getInterestValue());
        $this->assertEquals(0.0220, $interest->getInterestRates());

        $this->expectException(InterestValueException::class);

        $interest->appendInterestValue(65000);
    }

    public function testAssertEqualsInterestValue()
    {
        $interest = new Financial(1.95);

        $this->assertEquals(1.95, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(2.60, $interest->getInterestValue());
    }

    public function testResetInterestValue()
    {
        $interest = new Financial(4.38);

        $interest->resetInterestValue();

        $this->assertEquals(0.00, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(0.65, $interest->getInterestValue());

        $interest->resetInterestValue(1.85);

        $this->assertEquals(1.85, $interest->getInterestValue());
    }

    public function testResetTotalCapital()
    {
        $interest = new Financial(2.55);
        $interest->appendTotalCapital(550.25);

        $interest->resetTotalCapital();

        $this->assertEquals(0.00, $interest->getTotalCapital());

        $interest->appendTotalCapital(250.25);

        $this->assertEquals(250.25, $interest->getTotalCapital());

        $interest->resetTotalCapital(100.85);

        $this->assertEquals(100.85, $interest->getTotalCapital());
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsZero($numberInstallment, $valueInstallmentCalculated)
    {
        $interest = new Financial();
        $interest->appendTotalCapital(357.66);

        $this->assertEquals(
            $valueInstallmentCalculated,
            $interest->getValueCalculatedByInstallment($numberInstallment)
        );
    }

    /**
     * @return array
     */
    public function providerInstallmentsWhenInterestIsZero()
    {
        return [
            [1, 357.66000000000003],
            [2, 357.66000000000003],
            [3, 357.66000000000003],
            [4, 357.66000000000003],
            [5, 357.66000000000003],
            [6, 357.66000000000003],
            [7, 357.66000000000003],
            [8, 357.66000000000003],
            [9, 357.66000000000003],
            [10, 357.66000000000003],
            [11, 357.66000000000003],
            [12, 357.66000000000003],
        ];
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsNonZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsNonZero($numberInstallment, $valueInstallmentCalculated)
    {
        $interest = new Financial(2.99);
        $interest->appendTotalCapital(158.97);

        $this->assertEquals(
            $valueInstallmentCalculated,
            $interest->getValueCalculatedByInstallment($numberInstallment)
        );
    }

    /**
     * @return array
     */
    public function providerInstallmentsWhenInterestIsNonZero()
    {
        return [
            [1, 158.97],
            [2, 166.13481134016436],
            [3, 168.56975082286584],
            [4, 171.02801132613806],
            [5, 173.5095786880097],
            [6, 176.0144347152719],
            [7, 178.5425571947336],
            [8, 181.09391990694976],
            [9, 183.66849264240679],
            [10, 186.2662412201442],
            [11, 188.88712750879171],
            [12, 191.5311094499956],
        ];
    }
}
