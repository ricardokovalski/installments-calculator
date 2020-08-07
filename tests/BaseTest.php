<?php

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    private $currency;

    public function setUp()
    {
        $this->currency = new \Moguzz\Currencies\Real();
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function formattingInstallments(array $installments)
    {
        array_map(function (\Moguzz\Installment $installment) {
            $installment->valueCalculated = $this->currency->formatter($installment->getValueCalculated());
            $installment->addedValue = $this->currency->formatter($installment->getAddedValue());
            $installment->originalValue = $this->currency->formatter($installment->getOriginalValue());
        }, $installments);

        return $installments;
    }

}
