<?php

require __DIR__ . '../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Financial;

$calculator = (new Calculator(new Financial(2.99), new Real()))
    ->appendTotalPurchase(39.90)
    ->calculateInstallments()
    ->formattingInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
