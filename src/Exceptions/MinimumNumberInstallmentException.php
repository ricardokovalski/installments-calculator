<?php

namespace RicardoKovalski\InstallmentsCalculator\Exceptions;

use InvalidArgumentException;

final class MinimumNumberInstallmentException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("The minimum number of installments cannot be less than zero.");
    }
}