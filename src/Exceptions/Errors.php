<?php

namespace PopolniClub\Exceptions;

/**
 *
 * Class Errors
 *
 * @package PopolniClub\Exceptions
 *
 */
class Errors extends TransferException
{

    /**
     *
     * EXCEPTION
     *
     * @var OBJECT | STRING
     *
     */
    private $exception = null;
    /**
     *
     * INIT
     *
     * @param OBJECT | STRING $message
     *
     * @return VOID
     *
     */
    public function __construct($message)
    {

        $this->exception = $message;

    }
    /**
     *
     * GET REQUEST
     *
     * @return ARRAY | NULL
     *
     */
    public function getRequest()
    {

        if (

            method_exists($this->exception, 'getTrace') &&
            isset($this->exception->getTrace()[0]['args'])

        ) {

            return $this->exception->getTrace()[0]['args'];

        }

        return null;

    }
    /**
     *
     * GET RESPONSE
     *
     * @return STRING | NULL
     *
     */
    public function getResponse()
    {

        $error = null;

        if (is_object($this->exception)) {

            if (property_exists($this->exception, 'exception')) {

                $error = $this->exception->exception;

            } elseif (property_exists($this->exception, 'message')) {

                $error = $this->exception->message;

            }

        } else {

            $error = $this->exception;

        }

        return $error;

    }

}
