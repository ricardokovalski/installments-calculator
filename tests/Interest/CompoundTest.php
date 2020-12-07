<?php

class CompoundTest extends \PHPUnit_Framework_TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InvalidArgumentException::class);
        new \Moguzz\Interest\Types\Compound('XYZ');
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsZero($numberInstallment, $valueInstallmentCalculated)
    {
        $totalPurchase = 485.65;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Types\Compound())
                ->appendTotalCapital($totalPurchase)
                ->getValueCalculatedByInstallment($numberInstallment)
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
        $totalPurchase = 575.79;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Types\Compound(2.99))
                ->appendTotalCapital($totalPurchase)
                ->getValueCalculatedByInstallment($numberInstallment)
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