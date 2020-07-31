<?php

namespace Moguzz\Contracts;

interface Currency
{
    public function formatter($amount);
}