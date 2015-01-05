<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 11:15 AM
     */

    namespace TestOauthApp\Services\Payment;


    use TestOauthApp\Services\File\Customer;

    class CreditCardPayment
    {
        protected $responseProcessed;
        /**
         * @var null
         */
        private $responseRaw;

        private function __construct($response = NULL)
        {
            $this->responseRaw = $response;
            $this->responseProcessed = $this->processResponse($response);
        }

        private function processResponse($response)
        {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            return $array;
        }

        public static function newInstance($response)
        {
            return new static($response);
        }

        public function isOrderApproved()
        {
            return strcasecmp($this->responseProcessed['OrderStatus'], 'APPROVED') == 0;
        }

        public function isOrderCanceled()
        {
            return strcasecmp($this->responseProcessed['OrderStatus'], 'CANCELED') == 0;
        }

        public function getTransactionRefID()
        {
            return $this->responseProcessed['TransactionRef'];
        }

        public function getTransactionDate()
        {
            return $this->responseProcessed['TranDate'];
        }

        public function getTransactionTime()
        {
            return $this->responseProcessed['TranTime'];
        }

        public function getTransactionAmount()
        {
            $amount = $this->responseProcessed['PurchaseAmount'];

            return doubleval(str_replace('=N=', '', $amount));
        }

        public function getOrderDescription()
        {
            return $this->responseProcessed['OrderDescription'];
        }

        public function getCustomer()
        {
            $temp = new Customer(
                $this->responseProcessed['CustomerName'],
                $this->responseProcessed['CustomerEmail'],
                $this->responseProcessed['CustomerPhone']
            );

            return $temp;
        }

        public function getPAN()
        {
            return $this->responseProcessed['PAN'];
        }
    }