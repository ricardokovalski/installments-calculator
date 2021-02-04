<?php

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestAdapter;
use RicardoKovalski\InstallmentsCalculator\Currencies\Types\Real;
use RicardoKovalski\InstallmentsCalculator\Installment;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCollection;
use RicardoKovalski\InstallmentsCalculator\InstallmentCollectionIterator;
//use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;
use RicardoKovalski\InstallmentsCalculator\Money;
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;
use RicardoKovalski\InterestCalculation\Types\Financial;

class InstallmentCalculationTest extends TestCase
{
    private $interest;
    private $template;

    public function setUp()
    {
        $this->interest = new Financial(2.99);
        $this->template = new TemplateSetting();
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $this->interest->appendTotalCapital(88.90);

        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation(new InterestAdapter($this->interest)))
            ->applySetting($this->template)
            ->calculate();

        $this->assertCount(10, $calculator->getCollection()->getIterator());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $this->interest->appendTotalCapital(150.00);

        $this->template->resetLimitInstallments(false);
        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation(new InterestAdapter($this->interest)))
            ->applySetting($this->template)
            ->calculate();

        $this->assertCount(12, $calculator->getCollection()->getIterator());
    }

    public function testAssertEqualsInstallments()
    {
        $this->interest->appendTotalCapital(450.00);

        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation(new InterestAdapter($this->interest)))
            ->applySetting($this->template)
            ->calculate();

        $this->assertEquals(
            $this->createInstallments(),
            $calculator->getCollection()->getIterator()
        );
    }

    /**
     * @return InstallmentCollectionIterator
     */
    private function createInstallments()
    {
        $installments = [
            new Installment(new Money(450.00, $this->template->currency()), new Money(0, $this->template->currency()), 1),
            new Installment(new Money(235.14079732992, $this->template->currency()), new Money(20.281594659835, $this->template->currency()), 2),
            new Installment(new Money(159.05807777209, $this->template->currency()), new Money(27.174233316284, $this->template->currency()), 3),
            new Installment(new Money(121.03322182922, $this->template->currency()), new Money(34.132887316866, $this->template->currency()), 4),
            new Installment(new Money(98.231503314593, $this->template->currency()), new Money(41.157516572966, $this->template->currency()), 5),
            new Installment(new Money(83.041344930776, $this->template->currency()), new Money(48.248069584653, $this->template->currency()), 6),
            new Installment(new Money(72.200640496078, $this->template->currency()), new Money(55.404483472543, $this->template->currency()), 7),
            new Installment(new Money(64.078335502082, $this->template->currency()), new Money(62.626684016653, $this->template->currency()), 8),
            new Installment(new Money(57.768287300247, $this->template->currency()), new Money(69.914585702227, $this->template->currency()), 9),
            new Installment(new Money(52.726809177244, $this->template->currency()), new Money(77.268091772441, $this->template->currency()), 10),
            new Installment(new Money(48.607917662541, $this->template->currency()), new Money(84.687094287955, $this->template->currency()), 11),
            new Installment(new Money(45.180956182769, $this->template->currency()), new Money(92.171474193232, $this->template->currency()), 12),
        ];

        $installmentCollection = new InstallmentCollection();

        foreach ($installments as $installment) {
            $installmentCollection->appendInstallment($installment);
        }

        return new InstallmentCollectionIterator($installmentCollection);
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
        return [
            [
                [
                    [450.00, 'R$ 450,00'],
                    [0, 'R$ 0,00'],
                    [450.00, 'R$ 450,00'],
                ],
                new Installment(new Money(450.00, new Real()), new Money(0, new Real()), 1),
            ],
            [
                [
                    [235.14079732992, 'R$ 235,14'],
                    [20.281594659835, 'R$ 20,28'],
                    [470.28159465983998, 'R$ 470,28'],
                ],
                new Installment(new Money(235.14079732992, new Real()), new Money(20.281594659835, new Real()), 2),
            ],
            [
                [
                    [159.05807777209, 'R$ 159,06'],
                    [27.174233316284, 'R$ 27,17'],
                    [477.17423331627003, 'R$ 477,17'],
                ],
                new Installment(new Money(159.05807777209, new Real()), new Money(27.174233316284, new Real()), 3),
            ],
            [
                [
                    [121.03322182922, 'R$ 121,03'],
                    [34.132887316866, 'R$ 34,13'],
                    [484.13288731687999, 'R$ 484,13'],
                ],
                new Installment(new Money(121.03322182922, new Real()), new Money(34.132887316866, new Real()), 4),
            ],
            [
                [
                    [98.231503314593, 'R$ 98,23'],
                    [41.157516572966, 'R$ 41,16'],
                    [491.157516573, 'R$ 491,16'],
                ],
                new Installment(new Money(98.231503314593, new Real()), new Money(41.157516572966, new Real()), 5),
            ],
            [
                [
                    [83.041344930776, 'R$ 83,04'],
                    [48.248069584653, 'R$ 48,25'],
                    [498.24806958465604, 'R$ 498,25'],
                ],
                new Installment(new Money(83.041344930776, new Real()), new Money(48.248069584653, new Real()), 6),
            ],
            [
                [
                    [72.200640496078, 'R$ 72,20'],
                    [55.404483472543, 'R$ 55,40'],
                    [505.40448347254596, 'R$ 505,40'],
                ],
                new Installment(new Money(72.200640496078, new Real()), new Money(55.404483472543, new Real()), 7),
            ],
            [
                [
                    [64.078335502082, 'R$ 64,08'],
                    [62.626684016653, 'R$ 62,63'],
                    [512.62668401665599, 'R$ 512,63'],
                ],
                new Installment(new Money(64.078335502082, new Real()), new Money(62.626684016653, new Real()), 8),
            ],
            [
                [
                    [57.768287300247, 'R$ 57,77'],
                    [69.914585702227, 'R$ 69,91'],
                    [519.91458570222301, 'R$ 519,91'],
                ],
                new Installment(new Money(57.768287300247, new Real()), new Money(69.914585702227, new Real()), 9),
            ],
            [
                [
                    [52.726809177244, 'R$ 52,73'],
                    [77.268091772441, 'R$ 77,27'],
                    [527.26809177244002, 'R$ 527,27'],
                ],
                new Installment(new Money(52.726809177244, new Real()), new Money(77.268091772441, new Real()), 10),
            ],
            [
                [
                    [48.607917662541, 'R$ 48,61'],
                    [84.687094287955, 'R$ 84,69'],
                    [534.687094288, 'R$ 534,69'],
                ],
                new Installment(new Money(48.607917662541, new Real()), new Money(84.687094287955, new Real()), 11),
            ],
            [
                [
                    [45.180956182769, 'R$ 45,18'],
                    [92.171474193232, 'R$ 92,17'],
                    [542.17147419322805, 'R$ 542,17'],
                ],
                new Installment(new Money(45.180956182769, new Real()), new Money(92.171474193232, new Real()), 12),
            ],
        ];
    }
}
