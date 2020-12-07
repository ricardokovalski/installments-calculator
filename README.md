# ricardokovalski/calculator-installment

[![Latest Stable Version](https://poser.pugx.org/ricardokovalski/calculator-installment/v/stable)](https://packagist.org/packages/ricardokovalski/calculator-installments)
[![Author](http://img.shields.io/badge/author-@ricardokovalski-blue.svg?style=flat-square)](https://github.com/ricardokovalski)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/ricardokovalski/calculator-installments/blob/master/LICENSE)

## Instalação

```
composer require ricardokovalski/calculator-installment
```

## Uso básico

### Parcelas

Para obter uma coleção de parcelas, basta seguir o código abaixo.

```php
use Moguzz\CalculatorInstallments;
use Moguzz\Interest\Types\Financial;

$interest = new Financial(4.99);
$interest->appendTotalCapital(250.90);

$calculator = new CalculatorInstallments($interest);
$calculator->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
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
use Moguzz\TemplateSetting;
use Moguzz\Currencies\Dollar;

$template = new TemplateSetting();
$template->resetCurrency(new Dollar());
```

#### enricoNão limitar o parcelamento
```php
use Moguzz\TemplateSetting;

$template = new TemplateSetting();
$template->resetLimitInstallments(false);
```

#### Alterar número de parcelas
```php
use Moguzz\TemplateSetting;

$template = new TemplateSetting();
$template->resetNumberMaxInstallments(6);
```

#### Alterar o parcelamento mínimo
```php
use Moguzz\TemplateSetting;

$template = new TemplateSetting();
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);
```

Uma vez que o template tenha alguma configuração alterada, basta fazer a injeção do Template modificado à classe do Calculator.

```php
use Moguzz\CalculatorInstallments;
use Moguzz\TemplateSetting;
use Moguzz\Currencies\Dollar;
use Moguzz\Interest\Types\Financial;

$interest = new Financial(4.99);
$interest->appendTotalCapital(250.90);

$template = new TemplateSetting();
$template->resetCurrency(new Dollar());
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);
$template->resetLimitInstallments(false);
$template->resetNumberMaxInstallments(6);

$calculator = new CalculatorInstallments($interest);
$calculator->applySetting($template)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
```

### Formatando as parcelas

Para formatar a parcela de acordo com a moeda que está sendo utilizada, basta acessar o método formatter ao acessar um atributo de Installment, veja o exemplo: 

```php
use Moguzz\CalculatorInstallments;
use Moguzz\TemplateSetting;
use Moguzz\Interest\Types\Financial;

$interest = new Financial(2.99);
$interest->appendTotalCapital(343.90);

$template = new TemplateSetting();
$template->resetLimitValueInstallment();
$template->appendLimitValueInstallment(10.00);

$calculator = new CalculatorInstallments($interest);
$calculator->applySetting($template)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();

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
use Moguzz\Interest\Types\Compound;  // Composto
use Moguzz\Interest\Types\Financial; // Financiamento
use Moguzz\Interest\Types\Simple;    // Simples
```
### Tipos de Moeda

```php
use Moguzz\Currencies\Dollar;
use Moguzz\Currencies\Real;
```
