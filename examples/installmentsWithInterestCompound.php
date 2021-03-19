<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;

$interest = InterestCalculation::Financial(4.99);
$interest->appendTotalCapital(474.99);

$installmentCalculation = new InstallmentCalculation($interest);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();


