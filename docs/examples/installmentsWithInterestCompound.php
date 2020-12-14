<?php

require __DIR__ . '../../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Compound;

$interest = new Compound(4.99);
$interest->appendTotalCapital(474.99);

$calculator = new InstallmentCalculation($interest);
$calculator->calculate();

$collectionInstallments = $calculator->getCollection();
