# ricardokovalski/calculator-installment

[![Latest Stable Version](https://poser.pugx.org/ricardokovalski/calculator-installment/v/stable)](https://packagist.org/packages/ricardokovalski/holidays)
[![Author](http://img.shields.io/badge/author-@ricardokovalski-blue.svg?style=flat-square)](https://github.com/ricardokovalski)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/thephpleague/glide-symfony/blob/master/LICENSE)

## Instalação

```
composer require ricardokovalski/calculator-installment
```

## Uso básico

### Parcelas

Para obter um array de parcelas, basta seguir o código abaixo.

```php
use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Financial;

$calculator = new Calculator(new Financial(4.99), new Real());
$calculator->appendTotalPurchase(250.90)
    ->calculateInstallments();

$collectionInstallments = $calculator->getCollectionInstallments();
```

### Configurações

Por padrão o Calculator seta algumas configurações iniciais, tais como:

* Valor da venda igual à 0.00;
* Número máximo de parcelas igual à 12;
* Limitar o parcelamento igual à True;
* Valor mínimo parcelado igual à 5.00;

#### Adicionando o valor de venda
```php
->appendTotalPurchase(475.99)
```

#### Alterar número de parcelas
```php
->appendNumberInstallments(6)
```

#### Não limitar o parcelamento
```php
->hasLimitingInstallments(false)
```

#### Alterar o parcelamento mínimo
```php
->appendLimitValueInstallment(10.00)
```

### Formatando as parcelas

Utilize o método abaixo para formatar as saídas das parcelas com base na Moeda.

```php
->formattingInstallments()
```

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
