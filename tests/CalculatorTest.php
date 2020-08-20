<?php

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $interest;
    private $currency;

    public function setUp()
    {
        $this->interest = new \Moguzz\Interest\Financial(2.99);
        $this->currency = new \Moguzz\Currencies\Real();
    }

    public function testExpectedExceptionWhenExceedsMaximumNumberOfInstallments()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator($this->interest, $this->currency))->appendNumberInstallments(13);
    }

    public function testExpectedExceptionWhenMinimumNumberInstallmentsIsLess()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator($this->interest, $this->currency))->appendNumberInstallments(0);
    }

    public function testAssertEqualsAppendTotalPurchase()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(158.80);

        $this->assertEquals(158.80, $calculator->getTotalPurchase());
    }

    public function testAssertEqualsAppendNumberInstallments()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendNumberInstallments(6);

        $this->assertEquals(6, $calculator->getNumberMaxInstallments());
    }

    public function testAssertEqualsAppendLimitValueInstallment()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendLimitValueInstallment(7.99);

        $this->assertEquals(7.99, $calculator->getLimitValueInstallment());
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(88.90)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments();

        $this->assertCount(10, $calculator->getInstallments());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(150.00)
            ->hasLimitingInstallments(false)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments();

        $this->assertCount(12, $calculator->getInstallments());
    }

    /**
     * @dataProvider providerInstallmentsValueCalculated
     * @param \Moguzz\Installment $valueCalculated
     * @param $installment
     */
    public function testAssertEqualsValueCalculatedInstallments($valueCalculated, \Moguzz\Installment $installment)
    {
        $this->assertEquals($valueCalculated, $installment->getValueCalculated());
    }

    /**
     * @return array
     */
    public function providerInstallmentsValueCalculated()
    {
        return array(
            array(450.00, new \Moguzz\Installment(450.00, 1, 0)),
            array(235.14079732992, new \Moguzz\Installment(235.14079732992, 2, 20.281594659835)),
            array(159.05807777209, new \Moguzz\Installment(159.05807777209, 3, 27.174233316284)),
            array(121.03322182922, new \Moguzz\Installment(121.03322182922, 4, 34.132887316866)),
            array(98.231503314593, new \Moguzz\Installment(98.231503314593, 5, 41.157516572966)),
            array(83.041344930776, new \Moguzz\Installment(83.041344930776, 6, 48.248069584653)),
            array(72.200640496078, new \Moguzz\Installment(72.200640496078, 7, 55.404483472543)),
            array(64.078335502082, new \Moguzz\Installment(64.078335502082, 8, 62.626684016653)),
            array(57.768287300247, new \Moguzz\Installment(57.768287300247, 9, 69.914585702227)),
            array(52.726809177244, new \Moguzz\Installment(52.726809177244, 10, 77.268091772441)),
            array(48.607917662541, new \Moguzz\Installment(48.607917662541, 11, 84.687094287955)),
            array(45.180956182769, new \Moguzz\Installment(45.180956182769, 12, 92.171474193232)),
        );
    }

    public function testAssertEqualsInstallments()
    {
        $calculator = (new Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(450.00)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments();

        $this->assertEquals(
            $this->createInstallments(),
            $calculator->getInstallments()
        );
    }

    public function testAssertEqualsInstallmentsFormatting()
    {
        $calculator = (new Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(450.00)
            ->appendLimitValueInstallment(10.00)
            ->calculateInstallments()
            ->formattingInstallments();

        $this->assertEquals(
            $this->formattingInstallments($this->createInstallments()),
            $calculator->getInstallments()
        );
    }

    /**
     * @return array
     */
    private function createInstallments()
    {
        return array(
            new \Moguzz\Installment(450.00, 1, 0),
            new \Moguzz\Installment(235.14079732992, 2, 20.281594659835),
            new \Moguzz\Installment(159.05807777209, 3, 27.174233316284),
            new \Moguzz\Installment(121.03322182922, 4, 34.132887316866),
            new \Moguzz\Installment(98.231503314593, 5, 41.157516572966),
            new \Moguzz\Installment(83.041344930776, 6, 48.248069584653),
            new \Moguzz\Installment(72.200640496078, 7, 55.404483472543),
            new \Moguzz\Installment(64.078335502082, 8, 62.626684016653),
            new \Moguzz\Installment(57.768287300247, 9, 69.914585702227),
            new \Moguzz\Installment(52.726809177244, 10, 77.268091772441),
            new \Moguzz\Installment(48.607917662541, 11, 84.687094287955),
            new \Moguzz\Installment(45.180956182769, 12, 92.171474193232),
        );
    }

    /**
     * @param array $installments
     * @return array
     */
    private function formattingInstallments(array $installments)
    {
        array_map(function (\Moguzz\Installment $installment) {
            $installment->valueCalculated = $this->currency->formatter($installment->getValueCalculated());
            $installment->addedValue = $this->currency->formatter($installment->getAddedValue());
            $installment->originalValue = $this->currency->formatter($installment->getOriginalValue());
        }, $installments);

        return $installments;
    }

}