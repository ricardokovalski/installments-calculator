<?php

namespace RicardoKovalski\InstallmentsCalculator\Tests;

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\Contracts\InterestAdapter;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MaximumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MinimumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

class InstallmentCalculationConfigTest extends TestCase
{
    private $template;

    public function setUp()
    {
        $this->template = new InstallmentCalculationConfig(InterestCalculation::Financial(2.99));
    }

    public function testExpectedExceptionMaximumNumberInstallment()
    {
        $this->expectException(MaximumNumberInstallmentException::class);

        $this->template->resetNumberMaxInstallments(13);
    }

    public function testExpectedExceptionMinimumNumberInstallment()
    {
        $this->expectException(MinimumNumberInstallmentException::class);

        $this->template->resetNumberMaxInstallments(0);
    }

    public function testAssertEqualsResetInterest()
    {
        $this->assertInstanceOf(InterestAdapter::class, $this->template->getInterest());

        $this->template->resetInterest(InterestCalculation::Simple(2.99));

        $this->assertInstanceOf(InterestAdapter::class, $this->template->getInterest());
    }

    public function testAssertEqualsResetNumberMaxInstallmentsToSix()
    {
        $this->assertEquals(12, $this->template->getNumberMaxInstallments());

        $this->template->resetNumberMaxInstallments(6);

        $this->assertEquals(6, $this->template->getNumberMaxInstallments());

        $this->template->resetNumberMaxInstallments(12);

        $this->assertEquals(12, $this->template->getNumberMaxInstallments());
    }

    public function testAssertEqualsResetAndAppendLimitValueInstallment()
    {
        $this->template->resetLimitValueInstallment();

        $this->assertEquals(0, $this->template->getLimitValueInstallment());

        $this->template->appendLimitValueInstallment(7.99);

        $this->assertEquals(7.99, $this->template->getLimitValueInstallment());

        $this->template->appendLimitValueInstallment(2.99);

        $this->assertEquals(10.98, $this->template->getLimitValueInstallment());
    }

    public function testAssertEqualsIsLimitInstallment()
    {
        $this->assertTrue($this->template->installmentIsLimited());

        $this->template->resetLimitInstallments(false);

        $this->assertFalse($this->template->installmentIsLimited());
    }
}
