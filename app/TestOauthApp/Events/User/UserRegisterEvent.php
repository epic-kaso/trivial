<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:17 PM
     */

    namespace TestOauthApp\Events\User;


    class UserRegisterEvent
    {

        protected $user;

        function __construct($user)
        {
            $this->user = $user;
        }

        public function getUser()
        {
            return $this->user;
        }
    }