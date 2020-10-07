![header](https://raw.githubusercontent.com/martinjack/popolniclub/master/doc/header.png)
## Опис

[![Latest Stable Version](https://poser.pugx.org/jackmartin/popolniclub/v)](//packagist.org/packages/jackmartin/popolniclub) [![Total Downloads](https://poser.pugx.org/jackmartin/popolniclub/downloads)](//packagist.org/packages/jackmartin/popolniclub) [![License](https://poser.pugx.org/jackmartin/popolniclub/license)](https://packagist.org/packages/popolniclub/justin)

PHP бібліотека для роботи з API [PopolniClub](https://popolni.club/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Опис роботи бібліотеки](https://github.com/martinjack/popolniclub/wiki)

> [Тестування](https://github.com/martinjack/popolniclub/wiki/Tests)

# Документація

[API documentation](https://popolni.club/api.pdf)

# Вимоги

* PHP 5.6 або вище
* Composer

# Composer
```bash
composer require jackmartin/popolniclub
```

# Бібліотеки

[Guzzle](https://github.com/guzzle/guzzle)

# Основні методи API

1. Створити платіж
    * [sendPayment - Приклад 1](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#sendpayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-1)
    * [sendPayment - Приклад 2](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#sendpayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-2)
    * [sendPayment - Приклад 3](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#sendpayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-3)
2. Статус платежу
    * [statusPayment - Приклад 1](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#statuspayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-1)
    * [statusPayment - Приклад 2](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#statuspayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-2)
    * [statusPayment - Приклад 3](https://github.com/martinjack/popolniclub/blob/master/README.ua.md#statuspayment---%D0%BF%D1%80%D0%B8%D0%BA%D0%BB%D0%B0%D0%B4-3)
3. Поточний баланс
    * [currentBalance](https://github.com/martinjack/popolniclub#currentbalance)

# Приклади

### __construct()

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');
// $pophone = new Pophone();
// $pophone
//     ->setLogin()
//     ->setPassword()
//     ->setAPI()
//     ->setSandbox();
```

### sandbox()

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API', true);
```

### sendPayment() - Приклад 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

print_r(

    $pophone->sendPayment(

        [

            'transactionId' => 1000000001,
            'amount'        => 100,
            'msisdn'        => '380000000000',
            'templateID'    => 0

        ]

    )

);

```

### sendPayment() - Приклад 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

print_r(

    $pophone
        ->setTransactionID()
        ->setSumm(1)
        ->setPhone('380000000000')
        ->setTemplateID()
        ->addPayment()
        ->sendPayment()

);
```

### sendPayment() - Приклад 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

foreach (

    [
        [
            'phone' => '380000000000',
            'summ'  => 1
        ],
        [
            'phone' => '380000000001',
            'summ'  => 1
        ]
    ] 
    as 
    $key => $item

) {

    $pophone
        ->setTransactionID()
        ->setPhone($item['phone'])
        ->setSumm($item['summ'])
        ->setTemplateID()
        ->addPayment();

}

print_r(

    $pophone->sendPayment()->getData()

);
```

### statusPayment() - Приклад 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

print_r(

    $pophone->statusPayment(

        [

            [

                'transactionId' => 1000000001,
                'status'        => 0,

            ],

        ]
    )

);
```

### statusPayment() - Приклад 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

print_r(

    $pophone
        ->addTransaction(1000000001)
        ->statusPayment()

);
```

### statusPayment() - Приклад 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

foreach (

        [

            1000000001,
            1000000002,

        ] as $id

    ) {

        $pophone->addTransaction($id);

}

print_r(

    $pophone->statusPayment()->getData()
    // $pophone->statusPayment()->getRaw()
    // $pophone->statusPayment()->transaction()
    // $pophone->statusPayment()->status()

);

```

### currentBalance()

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логін', 'Ваш пароль API');

print_r(

    $pophone->currentBalance()->getData()
    // $pophone->currentBalance()->getRaw()
    // $pophone->currentBalance()->balance()
    // $pophone->currentBalance()->balance(true)
    // $pophone->currentBalance()->credit()

);
```