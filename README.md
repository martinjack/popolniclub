![header](https://raw.githubusercontent.com/martinjack/popolniclub/master/doc/header.png)
## Описание

[![Latest Stable Version](https://poser.pugx.org/jackmartin/popolniclub/v)](//packagist.org/packages/jackmartin/popolniclub) [![Total Downloads](https://poser.pugx.org/jackmartin/popolniclub/downloads)](//packagist.org/packages/jackmartin/popolniclub) [![License](https://poser.pugx.org/jackmartin/popolniclub/license)](https://packagist.org/packages/popolniclub/justin)

PHP библиотека для работы с API [PopolniClub](https://popolni.club/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Описание работы библиотеки](https://github.com/martinjack/popolniclub/wiki)

> [Тестирование](https://github.com/martinjack/popolniclub/wiki/Tests)

# Документация

[API documentation](https://popolni.club/api.pdf)

# Требования

* PHP 5.6 или выше
* Composer

# Composer
```bash
composer require jackmartin/popolniclub
```

# Библиотеки

[Guzzle](https://github.com/guzzle/guzzle)

# Основные методы API

1. Создать платёж
    * [sendPayment - Пример 1](https://github.com/martinjack/popolniclub#sendpayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-1)
    * [sendPayment - Пример 2](https://github.com/martinjack/popolniclub#sendpayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-2)
    * [sendPayment - Пример 3](https://github.com/martinjack/popolniclub#sendpayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-3)
2. Статус платежа
    * [statusPayment - Пример 1](https://github.com/martinjack/popolniclub#statuspayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-1)
    * [statusPayment - Пример 2](https://github.com/martinjack/popolniclub#statuspayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-2)
    * [statusPayment - Пример 3](https://github.com/martinjack/popolniclub#statuspayment---%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80-3)
3. Текущий баланс
    * [currentBalance](https://github.com/martinjack/popolniclub#currentbalance)

# Примеры

### __construct()

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');
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

$pophone = new Pophone('Ваш логин', 'Ваш пароль API', true);
```

### sendPayment() - Пример 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

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

### sendPayment() - Пример 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

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

### sendPayment() - Пример 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

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

### statusPayment() - Пример 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

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

### statusPayment() - Пример 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

print_r(

    $pophone
        ->addTransaction(1000000001)
        ->statusPayment()

);
```

### statusPayment() - Пример 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

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

$pophone = new Pophone('Ваш логин', 'Ваш пароль API');

print_r(

    $pophone->currentBalance()->getData()
    // $pophone->currentBalance()->getRaw()
    // $pophone->currentBalance()->balance()
    // $pophone->currentBalance()->balance(true)
    // $pophone->currentBalance()->credit()

);
```