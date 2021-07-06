<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$installmentCalculation = new InstallmentCalculation(new InstallmentCalculationConfig(InterestCalculation::Simple(1.99)));
$installmentCalculation->appendTotalPurchase(329.99);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
