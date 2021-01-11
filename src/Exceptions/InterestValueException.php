<?php

namespace RicardoKovalski\InstallmentsCalculator\Exceptions;

use InvalidArgumentException;

final class InterestValueException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Interest value is float type.');
    }
}
