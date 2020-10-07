<?php

namespace PopolniClub;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PopolniClub\Contracts\iPophone;
use PopolniClub\Data;
use PopolniClub\Exceptions\PophoneErrorException;
use PopolniClub\Exceptions\PophoneFieldsException;
use PopolniClub\Exceptions\PophoneResponseException;
use PopolniClub\Fields;

/**
 *
 * Class Pophone
 *
 * @package PopolniClub\Pophone
 *
 */
class Pophone extends Fields implements iPophone
{

    /**
     *
     * API
     *
     * @var STRING
     *
     */
    private $api = 'https://popolni.club/api';
    /**
     *
     * SANDBOX
     *
     * @var BOOLEAN
     *
     */
    private $sandbox = false;
    /**
     *
     * LOGIN
     *
     * @var STRING
     *
     */
    private $login = null;
    /**
     *
     * PASSWROD
     *
     * @var STRING
     *
     */
    private $password = null;
    /**
     *
     * INIT
     *
     * @param STRING $login
     * @param STRING $password
     * @param BOOLEAN $sandbox
     *
     * @return OBJECT
     *
     */
    public function __construct($login = null, $password = null, $sandbox = false)
    {

        $this->client = new Client();

        return $this
            ->setLogin($login)
            ->setPassword($password)
            ->setSandbox($sandbox);

    }
    /**
     *
     * SET API
     *
     * @param STRING $api
     *
     * @return OBJECT
     *
     */
    public function setAPI($api): object
    {

        $this->api = $api;

        return $this;

    }
    /**
     *
     * SET LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setLogin($login): object
    {

        $this->login = $login;

        return $this;

    }
    /**
     *
     * SET PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setPassword($password): object
    {

        $this->password = $password;

        return $this;

    }
    /**
     *
     * SET SANDBOX
     *
     * @param BOOLEAN $sandbox
     *
     * @return OBJECT
     *
     */
    public function setSandbox($sandbox): object
    {

        $this->sandbox = $sandbox;

        return $this;

    }
    /**
     *
     * AUTH
     *
     * @return STRING
     *
     * @throws PophoneFieldsException
     *
     */
    private function auth(): string
    {

        if ($this->login && $this->password) {

            return sprintf(

                '%s %s',

                'Basic',

                base64_encode(

                    sprintf(

                        '%s:%s',

                        $this->login,

                        $this->password

                    )

                )

            );

        }

        if ($this->login) {

            $error = 'Fields errors. Please enter >login< field';

        } else {

            $error = 'Fields errors. Please enter >password< field';

        }

        throw new PophoneFieldsException(

            $error

        );

    }
    /**
     *
     * OPTIONS
     *
     * @param ARRAY $data
     *
     * @return ARRAY
     *
     */
    private function options($data): array
    {

        $options = [

            'headers' => [

                'Content-Type'  => 'application/json',
                'Authorization' => $this->auth(),

            ],

        ];

        if ($data) {

            $options['body'] = json_encode($data);

        }

        return $options;

    }
    /**
     *
     * REQUEST
     *
     * @param STRING $method
     * @param ARRAY $data
     * @param STRING $type
     *
     * @return STRING
     *
     * @throws PophoneErrorException
     * @throws PophoneResponseException
     *
     */
    private function request($method = '', $data = [], $type = 'POST')
    {

        try {

            $this->setDefault();

            if (!$this->sandbox) {

                $response = $this->client->request(

                    $type,

                    $type === 'POST' ? $this->api : sprintf(

                        '%s?%s',

                        $this->api,

                        $method

                    ),

                    $this->options($data)

                );

                return $response->getBody()->getContents();

            } else {

                return [

                    'api'     => $this->api,
                    'options' => $this->options($data),

                ];

            }

        } catch (RequestException $exception) {

            throw new PophoneErrorException(

                $exception->getResponse()->getBody()->getContents()

            );

        } catch (Exception $exception) {

            throw new PophoneResponseException(

                $exception

            );

        }

        return false;

    }
    /**
     *
     * SEND PAYMENT
     *
     * @param ARRAY $data
     *
     * @return ARRAY
     *
     */
    public function sendPayment($data = [])
    {

        if ($data) {

            return new Data(

                $this->request(

                    '', $data

                )

            );

        }

        return new Data(

            $this->request(

                '', $this->payments

            )

        );

    }
    /**
     *
     * STATUS PAYMENT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function statusPayment($data = []): object
    {

        if ($data) {

            return new Data(

                $this->request(

                    '', $data

                )

            );

        } else {

            return new Data(

                $this->request(

                    '', $this->transactions

                )

            );

        }

    }
    /**
     *
     * CURRENT BALANCE
     *
     * @return OBJECT
     *
     */
    public function currentBalance(): object
    {

        return new Data(

            $this->request(

                'balance', [], 'GET'

            )

        );

    }

}
