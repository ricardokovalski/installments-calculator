# Installments Calculator

[![Latest Stable Version](https://poser.pugx.org/ricardokovalski/installments-calculator/v/stable)](https://packagist.org/packages/ricardokovalski/installments-calculator)
[![Author](http://img.shields.io/badge/author-@ricardokovalski-blue.svg?style=flat-square)](https://github.com/ricardokovalski)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/ricardokovalski/installments-calculator/blob/master/LICENSE)

## Instalação

```
composer require ricardokovalski/installments-calculator
```

## Uso básico

### Parcelas

Para obter uma coleção de parcelas, basta seguir o código abaixo.

```php
use RicardoKovalski\InstallmentsCalculator\Adapters\InterestCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$interest = InterestCalculation::Financial(4.99);
$interest->appendTotalCapital(250.90);

$installmentCalculationConfig = new InstallmentCalculationConfig();
$installmentCalculationConfig->resetLimitValueInstallment(10.00);

$installmentCalculation = new InstallmentCalculation($interest);
$installmentCalculation->resetCalculationConfig($installmentCalculationConfig);
$installmentCalculation->calculate();

$collection = $installmentCalculation->getCollection();
```

### Configurações

Por padrão o Calculator inicializa com um template com algumas configurações iniciais, tais como:

```
* Limitar o parcelamento    - True;
* Valor mínimo parcelado    - 5.00;
* Número máximo de parcelas - 12;
```

Você pode alterar as configurações do template através de alguns métodos.

#### Não limitar o parcelamento

```php
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$installmentCalculationConfig = new InstallmentCalculationConfig();
$installmentCalculationConfig->resetLimitInstallments(false);
```

#### Alterar número de parcelas

```php
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$installmentCalculationConfig = new InstallmentCalculationConfig();
$installmentCalculationConfig->resetNumberMaxInstallments(6);
```

#### Alterar o parcelamento mínimo

```php
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculationConfig;

$installmentCalculationConfig = new InstallmentCalculationConfig();
$installmentCalculationConfig->resetLimitValueInstallment();
$installmentCalculationConfig->appendLimitValueInstallment(10.00);
```
