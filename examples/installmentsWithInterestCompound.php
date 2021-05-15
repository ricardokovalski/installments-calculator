<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(4.99);
$interest->appendTotalCapital(474.99);

$installmentCalculation = new InstallmentCalculation(new InstallmentCalculationConfig($interest));
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
