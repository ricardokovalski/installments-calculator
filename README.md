# ricardokovalski/calculator-installment

[![Latest Stable Version](https://poser.pugx.org/ricardokovalski/calculator-installment/v/stable)](https://packagist.org/packages/ricardokovalski/calculator-installments)
[![Author](http://img.shields.io/badge/author-@ricardokovalski-blue.svg?style=flat-square)](https://github.com/ricardokovalski)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/thephpleague/glide-symfony/blob/master/LICENSE)

## Instalação

```
composer require ricardokovalski/calculator-installment
```

## Uso básico

### Parcelas

Para obter uma coleção de parcelas, basta seguir o código abaixo.

```php
use Moguzz\Calculator;
use Moguzz\Interest\Financial;

$calculator = new Calculator(new Financial(4.99));
$calculator->appendTotalPurchase(250.90)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
```

### Configurações

Por padrão o Calculator inicializa o valor de venda em 0.00, além também de setar um template com algumas configurações iniciais, tais como:

* Moeda igual à Real;
* Número máximo de parcelas igual à 12;
* Limitar o parcelamento igual à True;
* Valor mínimo parcelado igual à 5.00;

O valor de venda pode ser alterado acessando o método abaixo da class Calculator. 

#### Adicionando o valor de venda
```php
->appendTotalPurchase(475.99)
``` 

Você pode alterar as configurações do template através de alguns métodos.

#### Alterar número de parcelas
```php
$template = (new TemplateSetting())->setNumberMaxInstallments(6);
```

#### Não limitar o parcelamento
```php
$template = (new TemplateSetting())->setLimitInstallments(false);
```

#### Alterar o parcelamento mínimo
```php
$template = (new TemplateSetting())->setLimitValueInstallment(10.00);
```

#### Alterar a Moeda
```php
$template = (new TemplateSetting())->setCurrency(new Dollar());
```

Uma vez que o template tenha alguma configuração alterada, basta fazer a injeção do Template modificado à classe do Calculator.

```php
use Moguzz\Calculator;
use Moguzz\TemplateSetting;
use Moguzz\Currencies\Dollar;
use Moguzz\Interest\Financial;

$template = (new TemplateSetting())
    ->setCurrency(new Dollar())
    ->setLimitValueInstallment(10.00)
    ->setLimitInstallments(false)
    ->setNumberMaxInstallments(6);

$calculator = new Calculator(new Financial(4.99));
$calculator->appendTotalPurchase(250.90)
    ->setTemplateSetting($template)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
```

### Formatando as parcelas

Para formatar a parcela de acordo com a moeda que está sendo utilizada, basta acessar o método formatter ao acessar um atributo de Installment, veja o exemplo: 

```php
use Moguzz\Calculator;
use Moguzz\Interest\Financial;

$calculator = new Calculator(new Financial(4.99));
$calculator->appendTotalPurchase(250.90)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();

foreach ($collectionInstallments as $installment) {
    echo $installment->getValueCalculated()->formatter();
}
```

O Objeto Installment possui quatro propriedades:

* $valueCalculated -> Valor calculado da parcela
* $numberInstallment -> Número da parcela
* $addedValue -> Valor em juros acrescentado à parcela
* $originalValue -> Valor original da parcela

### Tipos de Juros

Juros de Financiamento utilize a classe abaixo:
```php
use Moguzz\Interest\Financial;
```

Juros Compostos utilize a classe abaixo:
```php
use Moguzz\Interest\Compound;
```

Juros Simples utilize a classe abaixo:
```php
use Moguzz\Interest\Simple;
```
### Tipos de Moeda

Moeda Real utilize a classe abaixo:
```php
use Moguzz\Currencies\Real;
```

Moeda Dollar utilize a classe abaixo:
```php
use Moguzz\Currencies\Dollar;
