<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/7/2015
     * Time: 9:24 PM
     */

    namespace TestOauthApp\Events\File;


    class UserFileSavedSuccessfully
    {

        protected $fileKey;

        function __construct($fileKey)
        {
            $this->fileKey = $fileKey;
        }

        /**
         * @return mixed
         */
        public function getFileKey()
        {
            return $this->fileKey;
        }

        /**
         * @param mixed $fileKey
         */
        public function setFileKey($fileKey)
        {
            $this->fileKey = $fileKey;
        }

    }