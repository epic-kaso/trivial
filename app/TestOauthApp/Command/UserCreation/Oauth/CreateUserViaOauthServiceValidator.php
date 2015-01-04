<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/31/14
     * Time: 3:09 AM
     */

    namespace TestOauthApp\Command\UserCreation\Oauth;


    use TestOauthApp\Command\UserCreation\Exceptions\CreateUserViaOauthServiceException;

    class CreateUserViaOauthServiceValidator
    {

        public $rules = [
            'code' => 'required'
        ];

        public function validate(CreateUserViaOauthServiceCommand $command)
        {
            $validation = \Validator::make(
                [
                    'code' => $command->code
                ], $this->rules);

            if ($validation->fails()) {
                $url = (string)$command->oauthProvider->getOauthService()->getAuthorizationUri();
                throw new CreateUserViaOauthServiceException("Code Required", $url);
            }
        }
    }