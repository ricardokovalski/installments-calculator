<?php

namespace Moguzz\Exceptions;

use InvalidArgumentException;

final class InterestValueException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Interest value is float type.");
    }
}