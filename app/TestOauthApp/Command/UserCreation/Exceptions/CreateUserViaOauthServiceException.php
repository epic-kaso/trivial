<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 12:45 PM
     */

    namespace TestOauthApp\Command\UserCreation\Exceptions;


    class CreateUserViaOauthServiceException extends \Exception
    {


        /**
         * @var int
         */
        private $redirect_url;

        function __construct($message, $redirect_url)
        {
            $this->message = $message;
            $this->redirect_url = $redirect_url;
        }

        public function getRedirectUrl()
        {
            return $this->redirect_url;
        }
    }