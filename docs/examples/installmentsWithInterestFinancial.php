<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\CalculatorInstallments;
use Moguzz\Interest\Types\Financial;

$interest = new Financial(2.99);
$interest->appendTotalCapital(39.90);

$calculator = new CalculatorInstallments($interest);
$calculator->calculate();

$collectionInstallments = $calculator->getCollection();
