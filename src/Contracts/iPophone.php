<?php

namespace PopolniClub\Contracts;

/**
 *
 * Interface iPophone
 *
 * @package PopolniClub\Contracts
 *
 */
interface iPophone
{

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
    public function __construct($login = null, $password = null, $sandbox = false);
    /**
     *
     * SET API
     *
     * @param STRING $api
     *
     * @return OBJECT
     *
     */
    public function setAPI($api);
    /**
     *
     * SET LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setLogin($login);
    /**
     *
     * SET PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setPassword($password);
    /**
     *
     * SET SANDBOX
     *
     * @param BOOLEAN $sandbox
     *
     * @return OBJECT
     *
     */
    public function setSandbox($sandbox);
    /**
     *
     * SEND PAYMENT
     *
     * @param ARRAY $data
     *
     * @return ARRAY
     *
     */
    public function sendPayment($data);
    /**
     *
     * STATUS PAYMENT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function statusPayment($data);
    /**
     *
     * CURRENT BALANCE
     *
     * @return ARRAY
     *
     */
    public function currentBalance();

}
