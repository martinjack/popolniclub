<?php

namespace PopolniClub\Contracts;

/**
 *
 * Interface iData
 *
 * @package PopolniClub\Contracts
 *
 */
interface iData
{

    /**
     *
     * INIT
     *
     * @param STRING $raw
     *
     * @return OBJECT
     *
     */
    public function __construct($raw);
    /**
     *
     * GET RAW
     *
     * @return STRING
     *
     */
    public function getRaw();
    /**
     *
     * GET DATA
     *
     * @return ARRAY
     *
     * @throws PophoneDataException
     *
     */
    public function getData();
    /**
     *
     * BALANCE
     *
     * @return INTEGER
     *
     */
    public function balance();
    /**
     *
     * CREDIT
     *
     * @return INTEGER
     *
     */
    public function credit();
    /**
     *
     * TRANSACTION
     *
     * @return INTEGER | ARRAY
     *
     */
    public function transaction();
    /**
     *
     * STATUS
     *
     * @return INTEGER | BOOLEN
     *
     */
    public function status();

}
