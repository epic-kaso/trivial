<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 11:36 AM
     */

    use TestOauthApp\Services\Payment\CreditCardPayment;

    class CreditCardProcessorTest extends TestCase
    {

        public function testProcessResponse()
        {
            $response = "<Message> <TranDate>05/01/2015</TranDate> <TranTime>11:36:24</TranTime> <TransactionRef>100155141106</TransactionRef> <OrderStatus>APPROVED</OrderStatus> <PurchaseAmount>=N=1.00</PurchaseAmount> <OrderDescription>MEDIAHUBB -- Purchase of 1 Gig Storage Space</OrderDescription> <ResponseDescription>Approved</ResponseDescription> <MerchantTransRef></MerchantTransRef> <PAN>418742XXXX5334</PAN> <MerchantName>GpayExpress Wallet</MerchantName> <CustomerName>Okafor Akachukwu</CustomerName> <CustomerEmail>lordkaso@gmail.com</CustomerEmail> <CustomerPhone>+2348060518576</CustomerPhone> </Message>";

            $processor = CreditCardPayment::newInstance($response);

            $this->assertTrue($processor->isOrderApproved());

            /*
             *  (
        'TranDate' => '05/01/2015'
        'TranTime' => '11:36:24'
        'TransactionRef' => '100155141106'
        'OrderStatus' => 'APPROVED'
        'PurchaseAmount' => '=N=1.00'
        'OrderDescription' => 'MEDIAHUBB -- Purchase of 1 Gig Storage Space'
        'ResponseDescription' => 'Approved'
        'MerchantTransRef' => Array ()
        'PAN' => '418742XXXX5334'
        'MerchantName' => 'GpayExpress Wallet'
        'CustomerName' => 'Okafor Akachukwu'
        'CustomerEmail' => 'lordkaso@gmail.com'
        'CustomerPhone' => '+2348060518576'
    )
             */

        }
    }