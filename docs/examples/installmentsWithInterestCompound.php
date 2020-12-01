<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Compound;

$calculator = (new Calculator(new Compound(4.99)))
    ->appendTotalPurchase(474.99)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
