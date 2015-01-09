<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/7/2015
     * Time: 9:24 PM
     */

    namespace TestOauthApp\Events\File;


    use UserFile;

    class UserFileSavedSuccessfully
    {

        protected $fileKey;
        /**
         * @var UserFile
         */
        private $file;

        function __construct($fileKey, UserFile $file = NULL)
        {
            $this->fileKey = $fileKey;
            $this->file = $file;
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

        /**
         * @return UserFile
         */
        public function getFile()
        {
            return $this->file;
        }

    }