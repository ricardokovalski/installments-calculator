<?php

use Moguzz\Interest\Types\Compound;
use PHPUnit\Framework\TestCase;

class CompoundTest extends TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InvalidArgumentException::class);
        new Compound('nUm3r0');
    }

    public function testExpectedExceptionWhenAppendInterestValueNotIsNumericType()
    {
        $interest = new Compound(2.20);

        $this->assertEquals(2.20, $interest->getInterestValue());
        $this->assertEquals(0.0220, $interest->getInterestRates());

        $this->expectException(InvalidArgumentException::class);

        $interest->appendInterestValue(65000);
    }

    public function testAssertEqualsInterestValue()
    {
        $interest = new Compound(1.95);

        $this->assertEquals(1.95, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(2.60, $interest->getInterestValue());
    }

    public function testResetInterestValue()
    {
        $interest = new Compound(4.38);

        $interest->resetInterestValue();

        $this->assertEquals(0.00, $interest->getInterestValue());

        $interest->appendInterestValue(0.65);

        $this->assertEquals(0.65, $interest->getInterestValue());

        $interest->resetInterestValue(1.85);

        $this->assertEquals(1.85, $interest->getInterestValue());
    }

    public function testResetTotalCapital()
    {
        $interest = new Compound(2.55);
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
        $interest = new Compound();
        $interest->appendTotalCapital(485.65);

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
            [1, 485.64999999999998],
            [2, 485.64999999999998],
            [3, 485.64999999999998],
            [4, 485.64999999999998],
            [5, 485.64999999999998],
            [6, 485.64999999999998],
            [7, 485.64999999999998],
            [8, 485.64999999999998],
            [9, 485.64999999999998],
            [10, 485.64999999999998],
            [11, 485.64999999999998],
            [12, 485.64999999999998],
        ];
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsNonZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsNonZero($numberInstallment, $valueInstallmentCalculated)
    {
        $interest = new Compound(2.99);
        $interest->appendTotalCapital(575.79);

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
            [1, 575.78999999999996],
            [2, 593.00612100000001],
            [3, 610.73700401790006],
            [4, 628.99804043803522],
            [5, 647.80508184713244],
            [6, 667.17445379436174],
            [7, 687.12296996281327],
            [8, 707.66794676470147],
            [9, 728.82721837296606],
            [10, 750.61915220231776],
            [11, 773.06266485316701],
            [12, 796.17723853227676],
        ];
    }

}