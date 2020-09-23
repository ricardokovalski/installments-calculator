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
        $template = (new \Moguzz\TemplateSetting())->setNumberMaxInstallments(13);
        (new \Moguzz\Calculator($this->interest, $this->currency))->setTemplateSetting($template);
    }

    public function testExpectedExceptionWhenMinimumNumberInstallmentsIsLess()
    {
        $this->expectException(InvalidArgumentException::class);
        $template = (new \Moguzz\TemplateSetting())->setNumberMaxInstallments(0);
        (new \Moguzz\Calculator($this->interest, $this->currency))->setTemplateSetting($template);
    }

    public function testAssertEqualsAppendTotalPurchase()
    {
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(158.80);

        $this->assertEquals(158.80, $calculator->getTotalPurchase());
    }

    public function testAssertEqualsAppendNumberInstallments()
    {
        $template = (new \Moguzz\TemplateSetting())->setNumberMaxInstallments(6);

        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->setTemplateSetting($template);

        $this->assertEquals(6, $calculator->template()->getNumberMaxInstallments());
    }

    public function testAssertEqualsAppendLimitValueInstallment()
    {
        $template = (new \Moguzz\TemplateSetting())->setLimitValueInstallment(7.99);

        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->setTemplateSetting($template);

        $this->assertEquals(7.99, $calculator->template()->getLimitValueInstallment());
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $template = (new \Moguzz\TemplateSetting())->setLimitValueInstallment(10.00);
        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(88.90)
            ->setTemplateSetting($template)
            ->calculateInstallments();

        $this->assertCount(10, $calculator->getCollectionInstallments()->getIterator());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $template = (new \Moguzz\TemplateSetting())
            ->setLimitInstallments(false)
            ->setLimitValueInstallment(10.00);

        $calculator = (new \Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(150.00)
            ->setTemplateSetting($template)
            ->calculateInstallments();

        $this->assertCount(12, $calculator->getCollectionInstallments()->getIterator());
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
        $template = (new \Moguzz\TemplateSetting())->setLimitValueInstallment(10.00);
        $calculator = (new Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(450.00)
            ->setTemplateSetting($template)
            ->calculateInstallments();

        $this->assertEquals(
            $this->createInstallments(),
            $calculator->getCollectionInstallments()->getIterator()
        );
    }

    public function testAssertEqualsInstallmentsFormatting()
    {
        $template = (new \Moguzz\TemplateSetting())->setLimitValueInstallment(10.00);
        $calculator = (new Moguzz\Calculator($this->interest, $this->currency))
            ->appendTotalPurchase(450.00)
            ->setTemplateSetting($template)
            ->calculateInstallments()
            ->formattingInstallments();

        $this->assertEquals(
            $this->formattingInstallments($this->createInstallments()),
            $calculator->getCollectionInstallments()->getIterator()
        );
    }

    /**
     * @return \Moguzz\InstallmentCollectionIterator
     */
    private function createInstallments()
    {
        $installments = array(
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

        $installmentCollection = new \Moguzz\InstallmentCollection();

        foreach ($installments as $installment) {
            $installmentCollection->appendInstallment($installment);
        }

        return new \Moguzz\InstallmentCollectionIterator($installmentCollection);
    }

    /**
     * @param \Moguzz\InstallmentCollectionIterator $installmentCollectionIterator
     * @return \Moguzz\InstallmentCollectionIterator
     */
    private function formattingInstallments(\Moguzz\InstallmentCollectionIterator $installmentCollectionIterator)
    {
        iterator_apply($installmentCollectionIterator, function(\Iterator $iterator) {
            $iterator->current()->valueCalculated = $this->currency->formatter($iterator->current()->getValueCalculated());
            $iterator->current()->addedValue = $this->currency->formatter($iterator->current()->getAddedValue());
            $iterator->current()->originalValue = $this->currency->formatter($iterator->current()->getOriginalValue());
            return true;
        }, array($installmentCollectionIterator));

        $installmentCollectionIterator->rewind();

        return $installmentCollectionIterator;
    }

}