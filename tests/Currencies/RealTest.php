<?php

use Moguzz\Currencies\Real;
use Moguzz\Money;
use PHPUnit\Framework\TestCase;

class RealTest extends TestCase
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
            ['R$ 1,00', new Money(1.00, new Real())],
            ['R$ 30,50', new Money(30.50, new Real())],
            ['R$ 102,35', new Money(102.35, new Real())],
            ['R$ 1.006,89', new Money(1006.89, new Real())],
            ['R$ 25.046,06', new Money(25046.06, new Real())],
            ['R$ 407.890,31', new Money(407890.31, new Real())],
        ];
    }
}