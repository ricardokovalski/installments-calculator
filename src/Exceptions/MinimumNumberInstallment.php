<?php

namespace Moguzz\Exceptions;

use InvalidArgumentException;

final class MinimumNumberInstallment extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("The minimum number of installments cannot be less than zero.");
    }
}