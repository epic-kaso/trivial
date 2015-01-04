<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:35 PM
     */

    namespace TestOauthApp\Command\UserCreation\Exceptions;


    use Illuminate\Support\Contracts\MessageProviderInterface;

    class CreateUserViaFormException extends \Exception
    {

        protected $messages;
        private $errorProvider;

        function __construct($messages, MessageProviderInterface $errorProvider)
        {
            $this->messages = $messages;
            $this->errorProvider = $errorProvider;
        }

        public function getMessages()
        {
            return $this->messages;
        }

        public function getErrorProvider()
        {
            return $this->errorProvider;
        }
    }