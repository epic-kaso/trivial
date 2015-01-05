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
        private $userFilePath;

        function __construct($userFileSize, $userFilePath)
        {
            $this->userFileSize = $userFileSize;
            $this->userFilePath = $userFilePath;
        }

        /**
         * @return mixed
         */
        public function getUserFileSize()
        {
            return $this->userFileSize;
        }

        /**
         * @return mixed
         */
        public function getUserFilePath()
        {
            return $this->userFilePath;
        }
    }