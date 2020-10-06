<?php

require_once 'vendor/autoload.php';

use PopolniClub\Exceptions\PophoneErrorException;
use PopolniClub\Exceptions\PophoneResponseException;
use PopolniClub\Pophone;

try {

    $pophone = new Pophone('Ваш логин', 'Ваш пароль API');

    print_r(

        $pophone->currentBalance()->getData()

    );

} catch (PophoneErrorException $exception) {

    print_r($exception->getResponse());

} catch (PophoneResponseException $exception) {

    print_r($exception->getResponse());

}
