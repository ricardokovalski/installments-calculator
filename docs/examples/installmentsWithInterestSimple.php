<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Simple;

$calculator = (new Calculator(new Simple(1.99)))
    ->appendTotalPurchase(329.99)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
