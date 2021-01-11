<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Simple;

$interest = new Simple(1.99);
$interest->appendTotalCapital(329.99);

$calculator = new InstallmentCalculation($interest);
$calculator->calculate();

$collectionInstallments = $calculator->getCollection();
