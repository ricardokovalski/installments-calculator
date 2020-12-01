<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Interest\Types\Compound;

$calculator = (new Calculator())
    ->appendTotalPurchase(474.99)
    ->applyInterest(new Compound(4.99))
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
