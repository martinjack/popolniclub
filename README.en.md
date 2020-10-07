![header](https://raw.githubusercontent.com/martinjack/popolniclub/master/doc/header.png)
## Description

[![Latest Stable Version](https://poser.pugx.org/jackmartin/popolniclub/v)](//packagist.org/packages/jackmartin/popolniclub) [![Total Downloads](https://poser.pugx.org/jackmartin/popolniclub/downloads)](//packagist.org/packages/jackmartin/popolniclub) [![License](https://poser.pugx.org/jackmartin/popolniclub/license)](https://packagist.org/packages/popolniclub/justin)

PHP library for working with API [PopolniClub](https://popolni.club/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Description of the library](https://github.com/martinjack/popolniclub/wiki)

> [Testing](https://github.com/martinjack/popolniclub/wiki/Tests)

# Documentation

[API documentation](https://popolni.club/api.pdf)

# Requirements

* PHP 5.6 or higher
* Composer

# Composer
```bash
composer require jackmartin/popolniclub
```

# Libraries

[Guzzle](https://github.com/guzzle/guzzle)

# Basic methods API

1. Create payment
    * [sendPayment - Example 1](https://github.com/martinjack/popolniclub/blob/master/README.en.md#sendpayment---example-1)
    * [sendPayment - Example 2](https://github.com/martinjack/popolniclub/blob/master/README.en.md#sendpayment---example-2)
    * [sendPayment - Example 3](https://github.com/martinjack/popolniclub/blob/master/README.en.md#sendpayment---example-3)
2. Payment status
    * [statusPayment - Example 1](https://github.com/martinjack/popolniclub/blob/master/README.en.md#statuspayment---example-1)
    * [statusPayment - Example 2](https://github.com/martinjack/popolniclub/blob/master/README.en.md#statuspayment---example-2)
    * [statusPayment - Example 3](https://github.com/martinjack/popolniclub/blob/master/README.en.md#statuspayment---example-3)
3. Current balance
    * [currentBalance](https://github.com/martinjack/popolniclub#currentbalance)

# Examples

### __construct()

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');
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

$pophone = new Pophone('Your login', 'Your password API', true);
```

### sendPayment() - Example 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

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

### sendPayment() - Example 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

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

### sendPayment() - Example 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

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

### statusPayment() - Example 1

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

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

### statusPayment() - Example 2

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

print_r(

    $pophone
        ->addTransaction(1000000001)
        ->statusPayment()

);
```

### statusPayment() - Example 3

```php
require_once 'vendor/autoload.php';

use PopolniClub\Pophone;

$pophone = new Pophone('Your login', 'Your password API');

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

$pophone = new Pophone('Your login', 'Your password API');

print_r(

    $pophone->currentBalance()->getData()
    // $pophone->currentBalance()->getRaw()
    // $pophone->currentBalance()->balance()
    // $pophone->currentBalance()->balance(true)
    // $pophone->currentBalance()->credit()

);
```