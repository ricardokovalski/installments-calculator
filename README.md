<h1 align="center">ricardokovalski/installments-calculator</h1>

<p align="center">
    <strong>Uma biblioteca PHP para calcular juros de parcelamentos.</strong>
</p>

<p align="center">
    <a href="https://github.com/ricardokovalski/installments-calculator"><img src="http://img.shields.io/badge/source-ricardokovalski/interest--calculation-blue.svg" alt="Source Code"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/php-%3E=5.6-777bb3.svg" alt="PHP Programming Language"></a>
    <a href="https://github.com/ricardokovalski/installments-calculator/releases"><img src="https://img.shields.io/github/release/ricardokovalski/installments-calculator.svg" alt="Source Code"></a>
    <a href="https://packagist.org/packages/ricardokovalski/installments-calculator"><img src="https://poser.pugx.org/ricardokovalski/installments-calculator/v/stable" alt="Source Code"></a>
    <a href="https://github.com/ricardokovalski"><img src="http://img.shields.io/badge/author-@ricardokovalski-blue.svg" alt="Author"></a>
    <a href="https://github.com/ricardokovalski/installments-calculator/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg" alt="Read License"></a>
</p>

<h2>Sobre</h2>

ricardokovalski/installments-calculator é uma biblioteca PHP que serve para calcular juros de parcelamentos.

<h2>Instalação</h2>

Instale este pacote como uma dependência usando [Composer](https://getcomposer.org).

```bash
composer require ricardokovalski/installments-calculator
```

<h2>Uso básico</h2>

<h3>InstallmentCalculationConfig</h3>

Para obtermos uma coleção com as parcelas calculadas, inicialmente devemos
instanciar um objeto InstallmentCalculationConfig. Esse objeto requer um tipo
de juros em seu construtor.

Com a classe InterestCalculation, podemos instanciar um tipo de juros qualquer,
ou seja, Financial, Compound e Simple.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
```

Ainda no objeto InstallmentCalculationConfig, podemos modificar algumas configurações
padrões, por exemplo:

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);

$interestCompound = InterestCalculation::Compound(1.99);
$interestCompound->appendTotalCapital(343.90);

$installmentCalculationConfig->resetInterest($interestCompound);
```

No exemplo acima, resetamos o tipo de juros para Compound, sendo que inicialmente,
InstallmentCalculationConfig havia sido instanciada com o tipo Financial.

Além de resetar o tipo de juros, podemos definir o número máximo de pacelas. Por
padrão, esse número máximo de parcelas é 12.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
$installmentCalculationConfig->resetNumberMaxInstallments(6);
```

No exemplo acima, acabamos de resetar o número máximo de pacelas para 6.

Outras opções que temos disponível é de limitar o parcelamento em uma 
valor mínimo e se este estiver configurado para limitar, podemos definir o 
valor limite.
Por padrão, já está habilitado esse limite no valor de 5.00.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
$installmentCalculationConfig->appendLimitValueInstallment(5.00);
```

No exemplo anterior, adicionamos mais 5.00 ao valor limite, ou seja, agora as parcelas
serão calculadas até que a última parcela não seja inferior à 10.00.
Caso queira que não se tenha esse limite configurado, basta desativar.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
$installmentCalculationConfig->resetLimitInstallments(false);
```

<h3>InstallmentCalculation</h3>

Para obter uma coleção de parcelas calculadas.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
$installmentCalculationConfig->resetLimitValueInstallment(10.00);

$installmentCalculation = new InstallmentCalculation($installmentCalculationConfig);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
```

<h3>Formatters</h3>

<h4>MonetaryFormatterConfig</h4>

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\IsoCodes; 
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

$formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);

$formatterConfig->resetLocale(Locale::EN_US)
    ->resetCurrencyIsoCode(IsoCodes::USD)
    ->resetFractionDigits(3);
```

<h4>MonetaryFormatter</h4>

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;

$formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);

$decimalFormatter = MonetaryFormatter::toDecimal($formatterConfig);
$intlCurrencyFormatter = MonetaryFormatter::toIntlCurrency($formatterConfig);
$intlDecimalFormatter = MonetaryFormatter::toIntlDecimal($formatterConfig);
```

<h3>Exemplo completo</h3>

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatter;
use RicardoKovalski\InstallmentsCalculator\Adapters\MonetaryFormatterConfig;
use RicardoKovalski\InstallmentsCalculator\Enums\Locale;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(2.99);
$interest->appendTotalCapital(343.90);

$installmentCalculationConfig = new InstallmentCalculationConfig($interest);
$installmentCalculationConfig->resetLimitValueInstallment(10.00);

$installmentCalculation = new InstallmentCalculation($installmentCalculationConfig);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();

$formatterConfig = MonetaryFormatterConfig::BRL(Locale::PT_BR);
$intlCurrencyFormatter = MonetaryFormatter::toIntlCurrency($formatterConfig);

foreach ($collection as $installment) {
    $intlCurrencyFormatter->format($installment->getValueCalculated());
}
```

<h2>Copyright and License</h2>

The ricardokovalski/installments-calculator library is copyright © [Ricardo Kovalski](https://github.com/ricardokovalski)
and licensed for use under the terms of the
MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
