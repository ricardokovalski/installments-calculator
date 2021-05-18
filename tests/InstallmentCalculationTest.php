<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\Installment;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;
use RicardoKovalski\InstallmentsCalculator\InstallmentCollection;
use RicardoKovalski\InstallmentsCalculator\InstallmentCollectionIterator;

class InstallmentCalculationTest extends TestCase
{
    private $interest;
    private $template;

    public function setUp()
    {
        $this->interest = InterestCalculation::Financial(2.99);

        $this->template = new InstallmentCalculationConfig($this->interest);
    }

    public function testAssertEqualsNumberInstallmentsCalculated()
    {
        $this->interest->appendTotalCapital(88.90);

        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation($this->template))->calculate();

        $this->assertCount(10, $calculator->getCollection()->getIterator());

        $this->template->resetNumberMaxInstallments(5);

        $calculator->calculate();

        $this->assertCount(5, $calculator->getCollection()->getIterator());
    }

    public function testAssertEqualsNumberInstallmentsCalculatedWhenNotLimitingInstallments()
    {
        $this->interest->appendTotalCapital(150.00);

        $this->template->resetLimitInstallments(false);
        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation($this->template))->calculate();

        $this->assertCount(12, $calculator->getCollection()->getIterator());
    }

    public function testAssertEqualsInstallments()
    {
        $this->interest->appendTotalCapital(450.00);

        $this->template->resetLimitValueInstallment();
        $this->template->appendLimitValueInstallment(10.00);

        $calculator = (new InstallmentCalculation($this->template))->calculate();

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
            new Installment(450.00, 0, 1),
            new Installment(235.14079732992, 20.281594659835, 2),
            new Installment(159.05807777209, 27.174233316284, 3),
            new Installment(121.03322182922, 34.132887316866, 4),
            new Installment(98.231503314593, 41.157516572966, 5),
            new Installment(83.041344930776, 48.248069584653, 6),
            new Installment(72.200640496078, 55.404483472543, 7),
            new Installment(64.078335502082, 62.626684016653, 8),
            new Installment(57.768287300247, 69.914585702227, 9),
            new Installment(52.726809177244, 77.268091772441, 10),
            new Installment(48.607917662541, 84.687094287955, 11),
            new Installment(45.180956182769, 92.171474193232, 12),
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
        $this->assertEquals($valueCalculated[0][0], $installment->getValueInstallment());
        $this->assertEquals($valueCalculated[1][0], $installment->getInterestValue());
        $this->assertEquals($valueCalculated[2][0], $installment->getTotalInterest());
    }

    /**
     * @return array
     */
    public function providerInstallmentsValueCalculated()
    {
        return [
            [
                [
                    [450.00],
                    [0],
                    [450.00],
                ],
                new Installment(450.00, 0, 1),
            ],
            [
                [
                    [235.14079732992],
                    [20.281594659835],
                    [470.28159465983998],
                ],
                new Installment(235.14079732992, 20.281594659835, 2),
            ],
            [
                [
                    [159.05807777209],
                    [27.174233316284],
                    [477.17423331627003],
                ],
                new Installment(159.05807777209, 27.174233316284, 3),
            ],
            [
                [
                    [121.03322182922],
                    [34.132887316866],
                    [484.13288731687999],
                ],
                new Installment(121.03322182922, 34.132887316866, 4),
            ],
            [
                [
                    [98.231503314593],
                    [41.157516572966],
                    [491.157516573],
                ],
                new Installment(98.231503314593, 41.157516572966, 5),
            ],
            [
                [
                    [83.041344930776],
                    [48.248069584653],
                    [498.24806958465604],
                ],
                new Installment(83.041344930776, 48.248069584653, 6),
            ],
            [
                [
                    [72.200640496078],
                    [55.404483472543],
                    [505.40448347254596],
                ],
                new Installment(72.200640496078, 55.404483472543, 7),
            ],
            [
                [
                    [64.078335502082],
                    [62.626684016653],
                    [512.62668401665599],
                ],
                new Installment(64.078335502082, 62.626684016653, 8),
            ],
            [
                [
                    [57.768287300247],
                    [69.914585702227],
                    [519.91458570222301],
                ],
                new Installment(57.768287300247, 69.914585702227, 9),
            ],
            [
                [
                    [52.726809177244],
                    [77.268091772441],
                    [527.26809177244002],
                ],
                new Installment(52.726809177244, 77.268091772441, 10),
            ],
            [
                [
                    [48.607917662541],
                    [84.687094287955],
                    [534.687094288],
                ],
                new Installment(48.607917662541, 84.687094287955, 11),
            ],
            [
                [
                    [45.180956182769],
                    [92.171474193232],
                    [542.17147419322805],
                ],
                new Installment(45.180956182769, 92.171474193232, 12),
            ],
        ];
    }
}
