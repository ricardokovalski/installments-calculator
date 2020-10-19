<?php

use Moguzz\Entities\Installment;
use Moguzz\Entities\Money;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $interest;
    private $currency;
    private $template;

    public function setUp()
    {
        $this->interest = new \Moguzz\Interest\Financial(2.99);
        $this->currency = new \Moguzz\Currencies\Real();
        $this->template = new \Moguzz\TemplateSetting();
    }

    public function testExpectedExceptionWhenExceedsMaximumNumberOfInstallments()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator($this->interest))->setTemplateSetting($this->template->setNumberMaxInstallments(13));
    }

    public function testExpectedExceptionWhenMinimumNumberInstallmentsIsLess()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator($this->interest))->setTemplateSetting($this->template->setNumberMaxInstallments(0));
    }

    public function testAssertEqualsAppendTotalPurchase()
    {
        $calculator = (new \Moguzz\Calculator($this->interest))
            ->appendTotalPurchase(new Money(158.80));

        $this->assertEquals(158.80, $calculator->getTotalPurchase());
    }

    public function testAssertEqualsAppendNumberInstallments()
    {
        $calculator = (new \Moguzz\Calculator($this->interest))
            ->setTemplateSetting($this->template->setNumberMaxInstallments(6));

        $this->assertEquals(6, $calculator->template()->getNumberMaxInstallments());
    }

    public function testAssertEqualsAppendLimitValueInstallment()
    {
        $calculator = (new \Moguzz\Calculator($this->interest))
            ->setTemplateSetting($this->template->setLimitValueInstallment(new Money(7.99)));

        $this->assertEquals(7.99, $calculator->template()->getLimitValueInstallment());
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $calculator = (new \Moguzz\Calculator($this->interest))
            ->appendTotalPurchase(new Money(88.90))
            ->setTemplateSetting($this->template->setLimitValueInstallment(new Money(10.00)))
            ->calculateInstallments();

        $this->assertCount(10, $calculator->getCollectionInstallments()->getIterator());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $calculator = (new \Moguzz\Calculator($this->interest))
            ->appendTotalPurchase(new Money(150.00))
            ->setTemplateSetting($this->template->setLimitInstallments(false)->setLimitValueInstallment(new Money(10.00)))
            ->calculateInstallments();

        $this->assertCount(12, $calculator->getCollectionInstallments()->getIterator());
    }

    /**
     * @dataProvider providerInstallmentsValueCalculated
     * @param Installment $valueCalculated
     * @param $installment
     */
    public function testAssertEqualsValueCalculatedInstallments($valueCalculated, Installment $installment)
    {
        $this->assertEquals($valueCalculated, $installment->getValueCalculated()->getAmount());
    }

    /**
     * @return array
     */
    public function providerInstallmentsValueCalculated()
    {
        return array(
            array(450.00, new Installment(new Money(450.00), 1, new Money(0))),
            array(235.14079732992, new Installment(new Money(235.14079732992), 2, new Money(20.281594659835))),
            array(159.05807777209, new Installment(new Money(159.05807777209), 3, new Money(27.174233316284))),
            array(121.03322182922, new Installment(new Money(121.03322182922), 4, new Money(34.132887316866))),
            array(98.231503314593, new Installment(new Money(98.231503314593), 5, new Money(41.157516572966))),
            array(83.041344930776, new Installment(new Money(83.041344930776), 6, new Money(48.248069584653))),
            array(72.200640496078, new Installment(new Money(72.200640496078), 7, new Money(55.404483472543))),
            array(64.078335502082, new Installment(new Money(64.078335502082), 8, new Money(62.626684016653))),
            array(57.768287300247, new Installment(new Money(57.768287300247), 9, new Money(69.914585702227))),
            array(52.726809177244, new Installment(new Money(52.726809177244), 10, new Money(77.268091772441))),
            array(48.607917662541, new Installment(new Money(48.607917662541), 11, new Money(84.687094287955))),
            array(45.180956182769, new Installment(new Money(45.180956182769), 12, new Money(92.171474193232))),
        );
    }

    public function testAssertEqualsInstallments()
    {
        $calculator = (new Moguzz\Calculator($this->interest))
            ->appendTotalPurchase(new Money(450.00))
            ->setTemplateSetting($this->template->setLimitValueInstallment(new Money(10.00)))
            ->calculateInstallments();

        $this->assertEquals(
            $this->createInstallments(),
            $calculator->getCollectionInstallments()->getIterator()
        );
    }

    public function testAssertEqualsInstallmentsFormatting()
    {
        $calculator = (new Moguzz\Calculator($this->interest))
            ->appendTotalPurchase(new Money(450.00))
            ->setTemplateSetting($this->template->setLimitValueInstallment(new Money(10.00)))
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
            new Installment(new Money(450.00), 1, new Money(0)),
            new Installment(new Money(235.14079732992), 2, new Money(20.281594659835)),
            new Installment(new Money(159.05807777209), 3, new Money(27.174233316284)),
            new Installment(new Money(121.03322182922), 4, new Money(34.132887316866)),
            new Installment(new Money(98.231503314593), 5, new Money(41.157516572966)),
            new Installment(new Money(83.041344930776), 6, new Money(48.248069584653)),
            new Installment(new Money(72.200640496078), 7, new Money(55.404483472543)),
            new Installment(new Money(64.078335502082), 8, new Money(62.626684016653)),
            new Installment(new Money(57.768287300247), 9, new Money(69.914585702227)),
            new Installment(new Money(52.726809177244), 10, new Money(77.268091772441)),
            new Installment(new Money(48.607917662541), 11, new Money(84.687094287955)),
            new Installment(new Money(45.180956182769), 12, new Money(92.171474193232)),
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

            $iterator->current()->valueCalculated = $iterator->current()->getValueCalculated()->formatter();
            $iterator->current()->addedValue = $iterator->current()->getAddedValue()->formatter();
            $iterator->current()->originalValue = $iterator->current()->getOriginalValue()->formatter();

            return true;

        }, array($installmentCollectionIterator));

        $installmentCollectionIterator->rewind();

        return $installmentCollectionIterator;

    }

}