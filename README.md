# Calculator Installments

Biblioteca para calcular juros em parcelamentos.

## Uso básico

### Parcelas

Para obter um array de parcelas, basta seguir o código abaixo.

```php
use Moguzz\Calculator;
use Moguzz\Currencies\Real;
use Moguzz\Interest\Financial;

$instance = (new Calculator(new Financial(0.00), new Real()))
    ->appendTotalPurchase(39.90)
    ->calculateInstallments()
    ->getInstallments();
```

### Configurações

Por padrão o Calculator seta algumas configurações default, segue elas:

* Valor da venda igual à 0.00;
* Número máximo de parcelas igual a 12;
* Valor mínimo parcelado igual à 5.00;
* Limitar o parcelamento igual à True;

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
->isLimitingInstallments(false)
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
```