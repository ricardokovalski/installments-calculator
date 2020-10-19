<?php

use Moguzz\Currencies\Dollar;
use Moguzz\Currencies\Dollar as DollarAlias;
use Moguzz\Entities\Money;

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
            $amount->formatter()
        );
    }

    /**
     * @return array
     */
    public function providerFormatter()
    {
        return [
            ['$ 9.85', new Money(9.85, new Dollar())],
            ['$ 62.74', new Money(62.74, new Dollar())],
            ['$ 587.00', new Money(587.00, new Dollar())],
            ['$ 4,250.25', new Money(4250.25, new Dollar())],
            ['$ 98,159.10', new Money(98159.10, new Dollar())],
            ['$ 999,900.70', new Money(999900.70, new Dollar())],
        ];
    }
}