<?php

use Moguzz\Entities\Money;

class RealTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerFormatter
     * @param $formattedValue
     * @param $amount
     */
    public function testAssertEqualFormatterCurrency($formattedValue, Money $amount)
    {
        $this->assertEquals(
            $formattedValue,
            $amount->formatter()
        );
    }

    /**
     * @return array
     */
    public function providerFormatter()
    {
        return [
            ['R$ 1,00', new Money(1.00)],
            ['R$ 30,50', new Money(30.50)],
            ['R$ 102,35', new Money(102.35)],
            ['R$ 1.006,89', new Money(1006.89)],
            ['R$ 25.046,06', new Money(25046.06)],
            ['R$ 407.890,31', new Money(407890.31)],
        ];
    }
}