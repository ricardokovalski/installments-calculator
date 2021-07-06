<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\IsoCodes;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;
use RicardoKovalski\InstallmentsCalculator\Enums\Patterns;
use RicardoKovalski\InstallmentsCalculator\Installment;
use RicardoKovalski\InstallmentsCalculator\InstallmentFormatter;

$formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);

$formatterConfig->resetCurrencyIsoCode(IsoCodes::USD);
$formatterConfig->resetLocale(Locale::EN_US);
$formatterConfig->resetFractionDigits(3);

$intlDecimalFormatter = MonetaryFormatter::toIntlDecimal($formatterConfig);

$installmentFormatter = new InstallmentFormatter($intlDecimalFormatter);

$installmentFormatter->resetPattern(Patterns::PATTERN_B);
$installmentFormatter->format(new Installment(350.00, 0,1));
