<?php

namespace PopolniClub;

use PopolniClub\Contracts\iFields;

/**
 *
 * Class Fields
 *
 * @package PopolniClub
 *
 */
class Fields implements iFields
{

    /**
     *
     * TRANSACTION ID
     *
     * @var INTEGER
     *
     */
    private $transactionID = 0;
    /**
     *
     * TEMPLATE ID
     *
     * @var INTEGER
     *
     */
    private $templateID = 0;
    /**
     *
     * SUMM
     *
     * @var INTEGER
     *
     */
    private $summ = 0;
    /**
     *
     * MSISDN
     * PHONE OR CARD NUMBER
     *
     * @var STRING
     *
     */
    private $msisdn = null;
    /**
     *
     * MSISDNOTICE
     *
     * @var STRING
     *
     */
    private $msisdnot = null;
    /**
     *
     * PAYMENTS
     *
     * @var ARRAY
     *
     */
    public $payments = [];
    /**
     *
     * TRANSACTIONS
     *
     * @var ARRAY
     *
     */
    public $transactions = [];
    /**
     *
     * SET SUMM
     *
     * @param INTEGER $summ
     *
     * @return OBJECT
     *
     */
    public function setSumm($summ): object
    {

        $this->summ = round($summ * 100);

        return $this;

    }
    /**
     *
     * SET TRANSACTION ID
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function setTransactionID($id = 0): object
    {

        if ($id) {

            $this->transactionID = $id;

        } else {

            $this->transactionID = round(microtime(true) * 1000);

        }

        return $this;

    }
    /**
     *
     * SET TEMPLATE ID
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function setTemplateID($id = 0): object
    {

        $this->templateID = $id;

        return $this;

    }
    /**
     *
     * SET PHONE
     *
     * @param STRING $phone
     *
     * @return OBJECT
     *
     */
    public function setPhone($phone): object
    {

        $this->msisdn = $phone;

        return $this;

    }
    /**
     *
     * SET CARD
     *
     * @param STRING $card
     *
     * @return OBJECT
     *
     */
    public function setCard($card): object
    {

        $this->msisdn = $card;

        return $this;

    }
    /**
     *
     * SET PHONE RECIPIENT
     *
     * @param STRING $phone
     *
     * @return OBJECT
     *
     */
    public function setPhoneRecipient($phone): object
    {

        $this->msisdnot = $phone;

        return $this;

    }
    /**
     *
     * ADD PAYMENT
     *
     * @return OBJECT
     *
     */
    public function addPayment(): object
    {

        $payment = [

            'transactionId' => $this->transactionID,
            'amount'        => $this->summ,
            'msisdn'        => $this->msisdn,
            'templateID'    => $this->templateID,

        ];

        if ($this->msisdnot) {

            $payment['msisdnNotice'] = $this->msisdnot;

        }

        array_push(

            $this->payments,

            $payment

        );

        unset($payment);

        return $this;

    }
    /**
     *
     * ADD TRANSACTION
     *
     * @param INTEGER $id
     *
     * @return OBJECT
     *
     */
    public function addTransaction($id): object
    {

        $this->transactions[] = [

            'transactionId' => $id,
            'status'        => 0,

        ];

        return $this;

    }
    /**
     *
     * SET DEFAULT
     *
     * @return VOID
     *
     */
    public function setDefault(): void
    {

        $this->payments = [];

    }

}
