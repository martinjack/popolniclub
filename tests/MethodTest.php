<?php
declare (strict_types = 1);

namespace PopolniClub\Tests;

use PHPUnit\Framework\TestCase;
use PopolniClub\Pophone;

/**
 *
 * Class MethodTest
 *
 * @package PopolniClub\Tests
 *
 */
final class MethodTest extends TestCase
{

    /**
     *
     * POPHONE
     *
     * @var OBJECT
     *
     */
    private $pophone = null;
    /**
     *
     * MSIS
     *
     * @var STRING
     *
     */
    private $msis = null;
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
     * INIT
     *
     * @return VOID
     *
     */
    public function setUp(): void
    {

        $this->pophone = new Pophone();
        $this->pophone
            ->setLogin(getenv('login'))
            ->setPassword(getenv('password'))
            ->setSandbox(getenv('sandbox'));

        $this->msis = getenv('msis');

    }
    /**
     *
     * TEAR DOWN
     *
     * @return VOID
     *
     */
    public function tearDown(): void
    {

        $this->pophone       = null;
        $this->transactionID = 0;
        $this->msis          = null;

    }
    /**
     *
     * TEST AVAILABLE API
     *
     * @return VOID
     *
     */
    public function testAvailableApi(): void
    {

        exec('ping -c 2 popolni.club', $output, $status);

        $this->assertFalse((bool) $status);

    }
    /**
     *
     * TEST SEND PAYMENT
     *
     * @return VOID
     *
     */
    public function testSendPayment(): void
    {

        $response = $this->pophone
            ->setTransactionID()
            ->setSumm(1)
            ->setPhone($this->msis)
            ->setTemplateID()
            ->addPayment()
            ->sendPayment();

        $this->assertIsArray($response->getData());

        $this->transactionID = $response->transaction();

        $this->assertNotEmpty($this->transactionID);

    }
    /**
     *
     * TEST STATUS PAYMENT
     *
     * @return VOID
     *
     */
    public function testStatusPayment(): void
    {

        $response = $this->pophone
            ->addTransaction($this->transactionID)
            ->statusPayment();

        $this->assertIsArray($response->getData());

        $this->assertIsInt($response->transaction());

    }
    /**
     *
     * TEST CURRENT BALANCE
     *
     * @return VOID
     *
     */
    public function testCurrentBalance(): void
    {

        $response = $this->pophone->currentBalance();

        $this->assertIsArray($response->getData());

        $this->assertNotEmpty(

            $response->balance()

        );

    }

}
