<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:43 PM
     */

    namespace TestOauthApp\Command\FileCreation;


    use Illuminate\Support\Contracts\MessageProviderInterface;

    class CreateUserFileException extends \Exception
    {

        /**
         * @var string
         */
        private $messages;
        /**
         * @var MessageProviderInterface
         */
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