<?php

namespace RicardoKovalski\InstallmentsCalculator;

final class CreateInstallment
{
    private $interestValue;

    private $total;

    private $installment;

    public function __construct($interestValue, $total, $installmentNumber)
    {
        $this->interestValue = $interestValue;
        $this->total = $total;

        $this->installment = new Installment($this->getInterestValue(), $this->getInterestValue() - $this->getTotal(), $installmentNumber);
    }

    public function getInterestValue()
    {
        return $this->interestValue;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getInstallment()
    {
        return $this->installment;
    }
}
