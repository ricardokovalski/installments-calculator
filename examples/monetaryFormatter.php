<?php

require __DIR__ . '../vendor/autoload.php';

use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\IsoCodes;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

$formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);

$formatterConfig->resetCurrencyIsoCode(IsoCodes::USD);
$formatterConfig->resetLocale(Locale::EN_US);
$formatterConfig->resetFractionDigits(3);

$decimalFormatter = MonetaryFormatter::toDecimal($formatterConfig);
$intlCurrencyFormatter = MonetaryFormatter::toIntlCurrency($formatterConfig);
$intlDecimalFormatter = MonetaryFormatter::toIntlDecimal($formatterConfig);

$decimalFormatter->format(39.90);
$intlCurrencyFormatter->format(39.90);
$intlDecimalFormatter->format(39.90);
