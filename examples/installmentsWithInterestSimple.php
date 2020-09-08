<?php

require __DIR__ . '../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Simple;

$calculator = (new Calculator(new Simple(1.99), new Real()))
    ->appendTotalPurchase(329.99)
    ->calculateInstallments()
    ->formattingInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
