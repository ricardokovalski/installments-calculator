<?php

class SimpleTest extends \PHPUnit_Framework_TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InvalidArgumentException::class);
        new \Moguzz\Interest\Simple('XYZ');
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsZero($numberInstallment, $valueInstallmentCalculated)
    {
        $totalPurchase = 250.08;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Simple())->getValueInstallmentCalculated($totalPurchase, $numberInstallment)
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
        $totalPurchase = 868.59;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Simple(2.99))->getValueInstallmentCalculated($totalPurchase, $numberInstallment)
        );
    }

    /**
     * @return array
     */
    public function providerInstallmentsWhenInterestIsNonZero()
    {
        return [
            [1, 894.56084099999998],
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