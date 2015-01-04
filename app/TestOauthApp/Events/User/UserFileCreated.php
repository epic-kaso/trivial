<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 7:07 PM
     */

    namespace TestOauthApp\Events\User;


    class UserFileCreated
    {

        protected $userFile;

        function __construct($userFile)
        {
            $this->userFile = $userFile;
        }


        /**
         * @return mixed
         */
        public function getUserFile()
        {
            return $this->userFile;
        }
    }