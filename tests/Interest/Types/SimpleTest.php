<?php

use RicardoKovalski\InstallmentsCalculator\Exceptions\InterestValueException;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Simple;
use PHPUnit\Framework\TestCase;

class SimpleTest extends TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InterestValueException::class);
        new Simple('nUm3r0*');
    }

    public function testExpectedExceptionWhenAppendInterestValueNotIsNumericType()
    {
        $interest = new Simple(2.20);

        $this->assertEquals(2.20, $interest->getInterestValue());
        $this->assertEquals(0.0220, $interest->getInterestRates());

        $this->expectException(InterestValueException::class);

        $interest->appendInterestValue(65000);
    }

    public function testAssertEqualsInterestValue()
    {
        $interest = new Simple(1.95);

        $this->assertEquals(1.95, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(2.60, $interest->getInterestValue());
    }

    public function testResetInterestValue()
    {
        $interest = new Simple(4.38);

        $interest->resetInterestValue();

        $this->assertEquals(0.00, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(0.65, $interest->getInterestValue());

        $interest->resetInterestValue(1.85);

        $this->assertEquals(1.85, $interest->getInterestValue());
    }

    public function testResetTotalCapital()
    {
        $interest = new Simple(2.55);
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
        $interest = new Simple();
        $interest->appendTotalCapital(250.08);

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
            [1, 250.08000000000001],
            [2, 250.08000000000001],
            [3, 250.08000000000001],
            [4, 250.08000000000001],
            [5, 250.08000000000001],
            [6, 250.08000000000001],
            [7, 250.08000000000001],
            [8, 250.08000000000001],
            [9, 250.08000000000001],
            [10, 250.08000000000001],
            [11, 250.08000000000001],
            [12, 250.08000000000001],
        ];
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsNonZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsNonZero($numberInstallment, $valueInstallmentCalculated)
    {
        $interest = new Simple(2.99);
        $interest->appendTotalCapital(868.59);

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
            [1, 868.59000000000003],
            [2, 894.56084099999998],
            [3, 894.56084099999998],
            [4, 894.56084099999998],
            [5, 894.56084099999998],
            [6, 894.56084099999998],
            [7, 894.56084099999998],
            [8, 894.56084099999998],
            [9, 894.56084099999998],
            [10, 894.56084099999998],
            [11, 894.56084099999998],
            [12, 894.56084099999998],
        ];
    }

}