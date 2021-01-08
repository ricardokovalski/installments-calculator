<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

interface Currency
{
    public function getPrefix();

    public function getDecimals();

    public function getDecPoint();

    public function getThousandsSep();
}