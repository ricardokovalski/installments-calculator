<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(39.90);

$installmentCalculation = new InstallmentCalculation($interest);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
