<?php

namespace Moguzz\Contracts;

interface Interest
{
    public function getValueInstallmentCalculated($totalPurchase, $installment);
}