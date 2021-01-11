<?php

use PHPUnit\Framework\TestCase;
use RicardoKovalski\InstallmentsCalculator\Currencies\Types\Dollar;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MaximumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\Exceptions\MinimumNumberInstallmentException;
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;

class TemplateSettingTest extends TestCase
{
    private $template;

    public function setUp()
    {
        $this->template = new TemplateSetting();
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

    public function testAssertInstanceOfResetCurrency()
    {
        $this->template->resetCurrency(new Dollar());

        $this->assertInstanceOf(Dollar::class, $this->template->currency());
    }

    public function testAssertEqualsIsLimitInstallment()
    {
        $this->assertTrue($this->template->installmentIsLimited());

        $this->template->resetLimitInstallments(false);

        $this->assertFalse($this->template->installmentIsLimited());
    }
}
