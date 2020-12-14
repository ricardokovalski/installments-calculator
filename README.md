# ricardokovalski/installments-calculator

[![Latest Stable Version](https://poser.pugx.org/ricardokovalski/calculator-installment/v/stable)](https://packagist.org/packages/ricardokovalski/installments-calculator)
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
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;

$interest = new Financial(4.99);
$interest->appendTotalCapital(250.90);

$calculator = new InstallmentCalculation($interest);
$calculator->calculate();

$collectionInstallments = $calculator->getCollection();
```

### Configurações

Por padrão o Calculator inicializa com um template com algumas configurações iniciais, tais como:

```
* Moeda                     - Real;
* Limitar o parcelamento    - True;
* Valor mínimo parcelado    - 5.00;
* Número máximo de parcelas - 12;
```

Você pode alterar as configurações do template através de alguns métodos.

#### Alterar a Moeda
```php
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;
use RicardoKovalski\InstallmentsCalculator\Currencies\Dollar;

$template = new TemplateSetting();
$template->resetCurrency(new Dollar());
```

#### Não limitar o parcelamento
```php
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;

$template = new TemplateSetting();
$template->resetLimitInstallments(false);
```

#### Alterar número de parcelas
```php
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;

$template = new TemplateSetting();
$template->resetNumberMaxInstallments(6);
```

#### Alterar o parcelamento mínimo
```php
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;

$template = new TemplateSetting();
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);
```

Uma vez que o template tenha alguma configuração alterada, basta fazer a injeção do Template modificado à classe do Calculator.

```php
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;
use RicardoKovalski\InstallmentsCalculator\Currencies\Dollar;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;

$interest = new Financial(4.99);
$interest->appendTotalCapital(250.90);

$template = new TemplateSetting();
$template->resetCurrency(new Dollar());
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);
$template->resetLimitInstallments(false);
$template->resetNumberMaxInstallments(6);

$calculator = new InstallmentCalculation($interest);
$calculator->applySetting($template)
    ->calculate();

$collectionInstallments = $calculator->getCollection();
```

### Formatando as parcelas

Para formatar a parcela de acordo com a moeda que está sendo utilizada, basta acessar o método formatter ao acessar um atributo de Installment, veja o exemplo: 

```php
use RicardoKovalski\InstallmentsCalculator\InstallmentCalculation;
use RicardoKovalski\InstallmentsCalculator\TemplateSetting;
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial;

$interest = new Financial(2.99);
$interest->appendTotalCapital(343.90);

$template = new TemplateSetting();
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);

$calculator = new InstallmentCalculation($interest);
$calculator->applySetting($template)
    ->calculate();

$collectionInstallments = $calculator->getCollection();

foreach ($collectionInstallments as $installment) {
    echo $installment->getValueCalculated()->formatter();
}
```

O Objeto Installment possui quatro propriedades:

```
$valueCalculated   -> Valor calculado da parcela
$numberInstallment -> Número da parcela
$addedValue        -> Valor em juros acrescentado à parcela
$originalValue     -> Valor original da parcela
```

### Tipos de Juros

```php
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Compound;  // Composto
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Financial; // Financiamento
use RicardoKovalski\InstallmentsCalculator\Interest\Types\Simple;    // Simples
```
### Tipos de Moeda

```php
use RicardoKovalski\InstallmentsCalculator\Currencies\Dollar;
use RicardoKovalski\InstallmentsCalculator\Currencies\Real;
```
