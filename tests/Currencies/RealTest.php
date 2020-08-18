<?php

class RealTest extends \PHPUnit_Framework_TestCase
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
            (new \Moguzz\Currencies\Real())->formatter($amount)
        );
    }

    /**
     * @return array
     */
    public function providerFormatter()
    {
        return [
            ['R$ 1,00', 1.00],
            ['R$ 30,50', 30.50],
            ['R$ 102,35', 102.35],
            ['R$ 1.006,89', 1006.89],
            ['R$ 25.046,06', 25046.06],
            ['R$ 407.890,31', 407890.31],
        ];
    }
}