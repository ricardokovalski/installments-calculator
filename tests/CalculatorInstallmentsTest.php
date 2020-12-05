<?php

use Moguzz\Currencies\Real;
use Moguzz\Entities\Installment;
use Moguzz\Entities\Money;

class CalculatorInstallmentsTest extends \PHPUnit_Framework_TestCase
{
    private $interest;
    private $template;

    public function setUp()
    {
        $this->interest = new \Moguzz\Interest\Types\Financial(2.99);
        $this->template = new \Moguzz\TemplateSetting();
    }

    public function testExpectedExceptionWhenExceedsMaximumNumberOfInstallments()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator($this->interest))
            ->loadTemplateSetting($this->template->setNumberMaxInstallments(13));
    }

    public function testExpectedExceptionWhenMinimumNumberInstallmentsIsLess()
    {
        $this->expectException(InvalidArgumentException::class);
        (new \Moguzz\Calculator())
            ->applyInterest($this->interest)
            ->loadTemplateSetting($this->template->setNumberMaxInstallments(0));
    }

    public function testAssertEqualsAppendTotalPurchase()
    {
        $calculator = (new \Moguzz\Calculator())
            ->appendTotalPurchase(158.80)
            ->applyInterest($this->interest);

        $this->assertEquals(158.80, $calculator->getTotalPurchase());
    }

    public function testAssertEqualsAppendNumberInstallments()
    {
        $calculator = (new \Moguzz\Calculator())
            ->applyInterest($this->interest)
            ->loadTemplateSetting($this->template->setNumberMaxInstallments(6));

        $this->assertEquals(6, $calculator->template()->getNumberMaxInstallments());
    }

    public function testAssertEqualsAppendLimitValueInstallment()
    {
        $calculator = (new \Moguzz\Calculator())
            ->applyInterest($this->interest)
            ->loadTemplateSetting($this->template->setLimitValueInstallment(7.99));

        $this->assertEquals(7.99, $calculator->template()->getLimitValueInstallment());
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $calculator = (new \Moguzz\Calculator())
            ->appendTotalPurchase(88.90)
            ->applyInterest($this->interest)
            ->loadTemplateSetting($this->template->setLimitValueInstallment(10.00))
            ->calculateInstallments();

        $this->assertCount(10, $calculator->getCollectionInstallments()->getIterator());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $calculator = (new \Moguzz\Calculator())
            ->appendTotalPurchase(150.00)
            ->applyInterest($this->interest)
            ->loadTemplateSetting($this->template->setLimitInstallments(false)->setLimitValueInstallment(10.00))
            ->calculateInstallments();

        $this->assertCount(12, $calculator->getCollectionInstallments()->getIterator());
    }

    public function testAssertEqualsInstallments()
    {
        $template = $this->template->setLimitValueInstallment(10.00);

        $calculator = (new Moguzz\Calculator())
            ->appendTotalPurchase(450.00)
            ->applyInterest($this->interest)
            ->loadTemplateSetting($template)
            ->calculateInstallments();

        $this->assertEquals(
            $this->createInstallments(),
            $calculator->getCollectionInstallments()->getIterator()
        );
    }

    /**
     * @return \Moguzz\InstallmentCollectionIterator
     */
    private function createInstallments()
    {
        $installments = array(
            new Installment(new Money(450.00, $this->template->getCurrency()), new Money(0, $this->template->getCurrency()), 1),
            new Installment(new Money(235.14079732992, $this->template->getCurrency()), new Money(20.281594659835, $this->template->getCurrency()), 2),
            new Installment(new Money(159.05807777209, $this->template->getCurrency()), new Money(27.174233316284, $this->template->getCurrency()), 3),
            new Installment(new Money(121.03322182922, $this->template->getCurrency()), new Money(34.132887316866, $this->template->getCurrency()), 4),
            new Installment(new Money(98.231503314593, $this->template->getCurrency()), new Money(41.157516572966, $this->template->getCurrency()), 5),
            new Installment(new Money(83.041344930776, $this->template->getCurrency()), new Money(48.248069584653, $this->template->getCurrency()), 6),
            new Installment(new Money(72.200640496078, $this->template->getCurrency()), new Money(55.404483472543, $this->template->getCurrency()), 7),
            new Installment(new Money(64.078335502082, $this->template->getCurrency()), new Money(62.626684016653, $this->template->getCurrency()), 8),
            new Installment(new Money(57.768287300247, $this->template->getCurrency()), new Money(69.914585702227, $this->template->getCurrency()), 9),
            new Installment(new Money(52.726809177244, $this->template->getCurrency()), new Money(77.268091772441, $this->template->getCurrency()), 10),
            new Installment(new Money(48.607917662541, $this->template->getCurrency()), new Money(84.687094287955, $this->template->getCurrency()), 11),
            new Installment(new Money(45.180956182769, $this->template->getCurrency()), new Money(92.171474193232, $this->template->getCurrency()), 12),
        );

        $installmentCollection = new \Moguzz\InstallmentCollection();

        foreach ($installments as $installment) {
            $installmentCollection->appendInstallment($installment);
        }

        return new \Moguzz\InstallmentCollectionIterator($installmentCollection);
    }

    /**
     * @dataProvider providerInstallmentsValueCalculated
     * @param $valueCalculated
     * @param Installment $installment
     */
    public function testAssertEqualsValueCalculatedInstallments($valueCalculated, Installment $installment)
    {
        $this->assertEquals($valueCalculated[0][0], $installment->getValueCalculated()->getAmount());
        $this->assertEquals($valueCalculated[0][1], $installment->getValueCalculated()->formatter());

        $this->assertEquals($valueCalculated[1][0], $installment->getAddedValue()->getAmount());
        $this->assertEquals($valueCalculated[1][1], $installment->getAddedValue()->formatter());

        $this->assertEquals($valueCalculated[2][0], $installment->getOriginalValue()->getAmount());
        $this->assertEquals($valueCalculated[2][1], $installment->getOriginalValue()->formatter());
    }

    /**
     * @return array
     */
    public function providerInstallmentsValueCalculated()
    {
        return array(
            array(
                array(
                    array(450.00, 'R$ 450,00'),
                    array(0, 'R$ 0,00'),
                    array(450.00, 'R$ 450,00'),
                ),
                new Installment(new Money(450.00, new Real()), new Money(0,  new Real()), 1)
            ),
            array(
                array(
                    array(235.14079732992, 'R$ 235,14'),
                    array(20.281594659835, 'R$ 20,28'),
                    array(470.28159465983998, 'R$ 470,28'),
                ),
                new Installment(new Money(235.14079732992, new Real()), new Money(20.281594659835, new Real()), 2)
            ),
            array(
                array(
                    array(159.05807777209, 'R$ 159,06'),
                    array(27.174233316284, 'R$ 27,17'),
                    array(477.17423331627003, 'R$ 477,17'),
                ),
                new Installment(new Money(159.05807777209, new Real()), new Money(27.174233316284, new Real()), 3)
            ),
            array(
                array(
                    array(121.03322182922, 'R$ 121,03'),
                    array(34.132887316866, 'R$ 34,13'),
                    array(484.13288731687999, 'R$ 484,13'),
                ),
                new Installment(new Money(121.03322182922, new Real()), new Money(34.132887316866, new Real()), 4)
            ),
            array(
                array(
                    array(98.231503314593, 'R$ 98,23'),
                    array(41.157516572966, 'R$ 41,16'),
                    array(491.157516573, 'R$ 491,16'),
                ),
                new Installment(new Money(98.231503314593, new Real()), new Money(41.157516572966, new Real()), 5)
            ),
            array(
                array(
                    array(83.041344930776, 'R$ 83,04'),
                    array(48.248069584653, 'R$ 48,25'),
                    array(498.24806958465604, 'R$ 498,25'),
                ),
                new Installment(new Money(83.041344930776, new Real()), new Money(48.248069584653, new Real()), 6)
            ),
            array(
                array(
                    array(72.200640496078, 'R$ 72,20'),
                    array(55.404483472543, 'R$ 55,40'),
                    array(505.40448347254596, 'R$ 505,40'),
                ),
                new Installment(new Money(72.200640496078, new Real()), new Money(55.404483472543, new Real()), 7)
            ),
            array(
                array(
                    array(64.078335502082, 'R$ 64,08'),
                    array(62.626684016653, 'R$ 62,63'),
                    array(512.62668401665599, 'R$ 512,63'),
                ),
                new Installment(new Money(64.078335502082, new Real()), new Money(62.626684016653, new Real()), 8)
            ),
            array(
                array(
                    array(57.768287300247, 'R$ 57,77'),
                    array(69.914585702227, 'R$ 69,91'),
                    array(519.91458570222301, 'R$ 519,91'),
                ),
                new Installment(new Money(57.768287300247, new Real()), new Money(69.914585702227, new Real()), 9)
            ),
            array(
                array(
                    array(52.726809177244, 'R$ 52,73'),
                    array(77.268091772441, 'R$ 77,27'),
                    array(527.26809177244002, 'R$ 527,27'),
                ),
                new Installment(new Money(52.726809177244, new Real()), new Money(77.268091772441, new Real()), 10)
            ),
            array(
                array(
                    array(48.607917662541, 'R$ 48,61'),
                    array(84.687094287955, 'R$ 84,69'),
                    array(534.687094288, 'R$ 534,69'),
                ),
                new Installment(new Money(48.607917662541, new Real()), new Money(84.687094287955, new Real()), 11)
            ),
            array(
                array(
                    array(45.180956182769, 'R$ 45,18'),
                    array(92.171474193232, 'R$ 92,17'),
                    array(542.17147419322805, 'R$ 542,17'),
                ),
                new Installment(new Money(45.180956182769, new Real()), new Money(92.171474193232, new Real()), 12)
            ),
        );
    }


}