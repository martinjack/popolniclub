<?php

namespace PopolniClub;

use PopolniClub\Contracts\iData;
use PopolniClub\Exceptions\PophoneDataException;

/**
 *
 * Class Data
 *
 * @package PopolniClub
 *
 */
class Data implements iData
{
    /**
     *
     * RAW
     *
     * @var STRING
     *
     */
    private $raw = null;
    /**
     *
     * INIT
     *
     * @param STRING $raw
     *
     * @return OBJECT
     *
     */
    public function __construct($raw)
    {

        $this->raw = $raw;

        return $this;

    }
    /**
     *
     * GET RAW
     *
     * @return STRING | ARRAY
     *
     */
    public function getRaw()
    {

        return $this->raw;

    }
    /**
     *
     * GET DATA
     *
     * @return ARRAY
     *
     * @throws PophoneDataException
     *
     */
    public function getData(): array
    {

        if ($this->raw) {

            return json_decode(

                $this->raw, true

            );

        }

        throw new PophoneDataException(

            'No data to display. Empty array data'

        );

    }
    /**
     *
     * FORMAT
     *
     * @param STRING $field
     *
     * @return STRING | INTEGER | ARRAY
     *
     */
    private function fields($field = '')
    {

        $temp = [];
        $data = $this->getData();

        if (count($data) > 1) {

            foreach ($data as $key => $item) {

                $temp[$key] = $item[$field];

            }

            return $temp;

        } else {

            return $data[0][$field];

        }

    }
    /**
     *
     * BALANCE
     *
     * @return INTEGER
     *
     */
    public function balance($format = false)
    {

        if ($format) {

            $balance = $this->getData()['currentBalance'];

            return substr_replace($balance, '.', strlen($balance) - 2, strlen($balance)) . substr($balance, strlen($balance) - 2, 2);

        }

        return $this->getData()['currentBalance'];

    }
    /**
     *
     * CREDIT
     *
     * @return INTEGER
     *
     */
    public function credit(): int
    {

        return $this->getData()['creditLimit'];

    }
    /**
     *
     * TRANSACTION
     *
     * @return INTEGER | ARRAY
     *
     */
    public function transaction()
    {

        return $this->fields('transactionId');

    }
    /**
     *
     * STATUS
     *
     * @return INTEGER | BOOLEN
     *
     */
    public function status()
    {

        return $this->fields('status');

    }

}
