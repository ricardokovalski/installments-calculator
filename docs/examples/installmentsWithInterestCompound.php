<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\CalculatorInstallments;
use Moguzz\Interest\Types\Compound;

$interest = new Compound(4.99);
$interest->appendTotalCapital(474.99);

$calculator = new CalculatorInstallments($interest);
$calculator->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
