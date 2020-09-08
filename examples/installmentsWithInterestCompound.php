<?php

require __DIR__ . '../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Compound;

$calculator = (new Calculator(new Compound(4.99), new Real()))
    ->appendTotalPurchase(474.99)
    ->calculateInstallments()
    ->formattingInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();