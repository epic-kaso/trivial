<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 1:26 PM
     */

    namespace TestOauthApp\Services\File;


    use Laracasts\Commander\Events\EventGenerator;

    class Customer
    {

        use EventGenerator;

        protected $name;
        protected $email;
        protected $phone;

        function __construct($name, $email, $phone)
        {
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
        }


        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * @param mixed $phone
         */
        public function setPhone($phone)
        {
            $this->phone = $phone;
        }
    }