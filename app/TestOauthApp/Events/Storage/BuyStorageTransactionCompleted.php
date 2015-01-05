<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:30 PM
     */

    namespace TestOauthApp\Events\Storage;


    use TestOauthApp\Services\Payment\CreditCardPayment;

    class BuyStorageTransactionCompleted
    {

        protected $transaction;

        function __construct(CreditCardPayment $transaction)
        {
            $this->transaction = $transaction;
        }

        /**
         * @return mixed
         */
        public function getCreditCardTransaction()
        {
            return $this->transaction;
        }


    }