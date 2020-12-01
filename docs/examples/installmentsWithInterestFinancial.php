<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Types\Financial;

$calculator = (new Calculator())
    ->appendTotalPurchase(39.90)
    ->applyInterest(new Financial(2.99))
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
