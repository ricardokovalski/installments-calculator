<?php

namespace Moguzz\Exceptions;

use InvalidArgumentException;

final class MaximumNumberInstallmentException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("The maximum number of installments cannot be greater than twelve.");
    }
}