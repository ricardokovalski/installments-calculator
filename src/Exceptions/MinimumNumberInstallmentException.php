<?php

namespace RicardoKovalski\InstallmentsCalculator\Exceptions;

use InvalidArgumentException;

/**
 * Class MinimumNumberInstallmentException
 *
 * @package RicardoKovalski\InstallmentsCalculator\Exceptions
 */
final class MinimumNumberInstallmentException extends InvalidArgumentException
{
    /**
     * MinimumNumberInstallmentException constructor.
     */
    public function __construct()
    {
        parent::__construct('The minimum number of installments cannot be less than zero.');
    }
}
