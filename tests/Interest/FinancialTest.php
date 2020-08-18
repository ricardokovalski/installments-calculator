<?php

class FinancialTest extends \PHPUnit_Framework_TestCase
{
    public function testExpectedExceptionWhenInterestNotIsNumericType()
    {
        $this->expectException(InvalidArgumentException::class);
        new \Moguzz\Interest\Financial('XYZ');
    }

    /**
     * @dataProvider providerInstallmentsWhenInterestIsZero
     * @param $numberInstallment
     * @param $valueInstallmentCalculated
     */
    public function testAssertEqualValueInstallmentWhenInterestIsZero($numberInstallment, $valueInstallmentCalculated)
    {
        $totalPurchase = 357.66;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Financial())->getValueInstallmentCalculated($totalPurchase, $numberInstallment)
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
        $totalPurchase = 158.97;

        $this->assertEquals(
            $valueInstallmentCalculated,
            (new \Moguzz\Interest\Financial(2.99))->getValueInstallmentCalculated($totalPurchase, $numberInstallment)
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