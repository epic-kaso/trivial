<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 9:50 PM
     */

    namespace TestOauthApp\Events\User;


    class UserFileDeleted
    {

        protected $userFileSize;

        function __construct($userFileSize)
        {
            $this->userFileSize = $userFileSize;
        }

        /**
         * @return mixed
         */
        public function getUserFileSize()
        {
            return $this->userFileSize;
        }
    }