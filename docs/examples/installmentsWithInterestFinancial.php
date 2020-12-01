<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Financial;

$calculator = (new Calculator(new Financial(2.99)))
    ->appendTotalPurchase(39.90)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
