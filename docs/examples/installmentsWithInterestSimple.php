<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Types\Simple;

$calculator = (new Calculator())
    ->appendTotalPurchase(329.99)
    ->applyInterest(new Simple(1.99))
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
