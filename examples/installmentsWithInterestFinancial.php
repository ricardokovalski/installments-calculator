<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$installmentCalculation = new InstallmentCalculation(new InstallmentCalculationConfig(InterestCalculation::Financial(2.99)));
$installmentCalculation->appendTotalPurchase(39.90);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
