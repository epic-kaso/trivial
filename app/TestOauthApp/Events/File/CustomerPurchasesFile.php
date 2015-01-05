<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 1:30 PM
     */

    namespace TestOauthApp\Events\File;


    use TestOauthApp\Services\File\Customer;
    use UserFile;

    class CustomerPurchasesFile
    {

        protected $customer;
        protected $userFile;

        function __construct(Customer $customer, UserFile $userFile)
        {
            $this->customer = $customer;
            $this->userFile = $userFile;
        }

        /**
         * @return Customer
         */
        public function getCustomer()
        {
            return $this->customer;
        }

        /**
         * @return UserFile
         */
        public function getUserFile()
        {
            return $this->userFile;
        }

    }