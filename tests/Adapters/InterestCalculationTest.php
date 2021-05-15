<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;

/**
 * Class InterestCalculationTest
 * @package RicardoKovalski\InstallmentsCalculator\Tests\Adapters
 */
class InterestCalculationTest extends TestCase
{
    /**
     * @var InterestCalculation
     */
    private $interest;

    public function setUp()
    {
        $this->interest = InterestCalculation::Financial(2.99);
    }

    public function testAssertEqualsAppendTotalCapital()
    {
        $this->interest->appendTotalCapital(299.70);
        $this->assertEquals(299.70, $this->interest->getTotalCapital());
    }

    public function testAssertEqualsResetTotalCapital()
    {
        $this->interest->resetTotalCapital(150);
        $this->assertEquals(150, $this->interest->getTotalCapital());
    }

    public function testAssertEqualsAppendInterestValue()
    {
        $this->interest->appendInterestValue(1.99);
        $this->assertEquals(4.98, $this->interest->getInterestValue());
    }

    public function testAssertEqualsResetInterestValue()
    {
        $this->interest->resetInterestValue(2.05);
        $this->assertEquals(2.05, $this->interest->getInterestValue());
    }

    public function testAssertEqualsGetInterestRate()
    {
        $this->assertEquals(0.0299, $this->interest->getInterestRates());
    }

    /**
     * @dataProvider providerInterestValueCalculated
     * @param $valueCalculated
     * @param $installmentNumber
     */
    public function testAssertEqualsInterestByInstallmentNumber($valueCalculated, $installmentNumber)
    {
        $this->interest->appendTotalCapital(250);
        $this->assertEquals($valueCalculated, $this->interest->getInterestByInstallmentNumber($installmentNumber));
    }

    /**
     * @return array
     */
    public function providerInterestValueCalculated()
    {
        return [
            [250.00, 1],
            [261.2675525888, 2],
            [265.09679628682, 3],
            [268.96271517604, 4],
            [272.86528698498, 5],
            [276.80448310259, 6],
        ];
    }
}
