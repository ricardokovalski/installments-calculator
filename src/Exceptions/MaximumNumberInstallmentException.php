<?php

namespace RicardoKovalski\InstallmentsCalculator\Exceptions;

use InvalidArgumentException;

/**
 * Class MaximumNumberInstallmentException
 *
 * @package RicardoKovalski\InstallmentsCalculator\Exceptions
 */
final class MaximumNumberInstallmentException extends InvalidArgumentException
{
    /**
     * MaximumNumberInstallmentException constructor.
     */
    public function __construct()
    {
        parent::__construct('The maximum number of installments cannot be greater than twelve.');
    }
}
