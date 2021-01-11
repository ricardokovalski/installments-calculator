<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;

$interest = new Financial(2.99);
$interest->appendTotalCapital(39.90);

$calculator = new InstallmentCalculation($interest);
$calculator->calculate();

$collectionInstallments = $calculator->getCollection();
