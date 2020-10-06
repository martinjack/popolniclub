<?php

namespace PopolniClub\Contracts;

/**
 *
 * Interface iFields
 *
 * @package PopolniClub\Contracts
 *
 */
interface iFields
{

    /**
     *
     * SET SUMM
     *
     * @param INTEGER $summ
     *
     * @return OBJECT
     *
     */
    public function setSumm($summ);
    /**
     *
     * SET TRANSACTION ID
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function setTransactionID($id = 0);
    /**
     *
     * SET TEMPLATE ID
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function setTemplateID($id = 0);
    /**
     *
     * SET PHONE
     *
     * @param STRING $phone
     *
     * @return OBJECT
     *
     */
    public function setPhone($phone);
    /**
     *
     * SET CARD
     *
     * @param STRING $card
     *
     * @return OBJECT
     *
     */
    public function setCard($card);
    /**
     *
     * SET PHONE RECIPIENT
     *
     * @param STRING $phone
     *
     * @return OBJECT
     *
     */
    public function setPhoneRecipient($phone);
    /**
     *
     * ADD PAYMENT
     *
     * @return OBJECT
     *
     */
    public function addPayment();
    /**
     *
     * ADD TRANSACTION
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function addTransaction($id);
    /**
     *
     * SET DEFAULT
     *
     * @return VOID
     *
     */
    public function setDefault();
}
