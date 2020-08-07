<?php

class CalculatorTest extends BaseTest
{
    private $calculator;

    public function setUp()
    {
        parent::setUp();

        $this->calculator = new \Moguzz\Calculator(
            new \Moguzz\Interest\Financial(2.99),
            $this->getCurrency()
        );
    }

    public function testExpectedExceptionWhenExceedsMaximumNumberOfInstallments()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->appendNumberInstallments(13);
    }

    public function testExpectedExceptionWhenMinimumNumberInstallmentsIsLess()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->appendNumberInstallments(0);
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $this->assertCount(
            4,
            $this->getInstallmentsCalculated()
        );
    }

    public function testAssertEqualsLastValueInstallments()
    {
        $this->assertEquals(
            10.731612335524,
            end($this->getInstallmentsCalculated())->getValueCalculated()
        );
    }

    public function testAssertEqualsLastAddedValueInstallments()
    {
        $this->assertEquals(
            3.0264493420954,
            end($this->getInstallmentsCalculated())->getAddedValue()
        );
    }

    public function testAssertEqualsInstallments()
    {
        $this->assertEquals(
            $this->createInstallments(),
            $this->getInstallmentsCalculated()
        );
    }

    public function testAssertEqualsInstallmentsFormatting()
    {
        $this->assertEquals(
            $this->formattingInstallments($this->createInstallments()),
            $this->getInstallmentsCalculatedFormatting()
        );
    }

    private function getInstallmentsCalculated()
    {
        return $this->calculator->appendTotalPurchase(39.90)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments()
            ->getInstallments();
    }

    private function getInstallmentsCalculatedFormatting()
    {
        return $this->calculator->appendTotalPurchase(39.90)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments()
            ->formattingInstallments()
            ->getInstallments();
    }

    private function createInstallments()
    {
        return array(
            new \Moguzz\Installment(39.9, 1, 0),
            new \Moguzz\Installment(20.849150696586, 2, 1.798301393172),
            new \Moguzz\Installment(14.103149562459, 3, 2.4094486873772),
            new \Moguzz\Installment(10.731612335524, 4, 3.0264493420954),
        );
    }

    /**
     * @param array $installments
     * @return array
     */
    /*private function formattingInstallments(array $installments)
    {
        array_map(function (\Moguzz\Installment $installment) {
            $installment->valueCalculated = $this->currency->formatter($installment->getValueCalculated());
            $installment->addedValue = $this->currency->formatter($installment->getAddedValue());
            $installment->originalValue = $this->currency->formatter($installment->getOriginalValue());
        }, $installments);

        return $installments;
    }*/

}