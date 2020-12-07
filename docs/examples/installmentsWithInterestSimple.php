<?php

require __DIR__ . '../../vendor/autoload.php';

use Moguzz\CalculatorInstallments;
use Moguzz\Interest\Types\Simple;

$interest = new Simple(1.99);
$interest->appendTotalCapital(329.99);

$calculator = new CalculatorInstallments($interest);
$calculator->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
