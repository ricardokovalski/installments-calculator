<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . '../vendor/autoload.php';

use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Financial;

$calculator = (new Calculator(new Financial(2.99), new Real()))
    ->appendTotalPurchase(39.90)
    ->calculateInstallments()
    ->formattingInstallments();

$installments = $calculator->getInstallments();
