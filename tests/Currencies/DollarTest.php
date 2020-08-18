<?php

class DollarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerFormatter
     * @param $formattedValue
     * @param $amount
     */
    public function testAssertEqualFormatterCurrency($formattedValue, $amount)
    {
        $this->assertEquals(
            $formattedValue,
            (new \Moguzz\Currencies\Dollar())->formatter($amount)
        );
    }

    /**
     * @return array
     */
    public function providerFormatter()
    {
        return [
            ['$ 9.85', 9.85],
            ['$ 62.74', 62.74],
            ['$ 587.00', 587.00],
            ['$ 4,250.25', 4250.25],
            ['$ 98,159.10', 98159.10],
            ['$ 999,900.70', 999900.70],
        ];
    }
}