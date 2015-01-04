<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:32 PM
     */

    namespace TestOauthApp\Command\UserCreation\Form;


    use TestOauthApp\Command\UserCreation\Exceptions\CreateUserViaFormException;

    class CreateUserViaFormValidator
    {

        public $rules = [
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ];

        public function validate(CreateUserViaFormCommand $command)
        {
            $validation = \Validator::make(
                [
                    'email'                 => $command->email,
                    'password'              => $command->password,
                    'password_confirmation' => $command->password_confirmation
                ], $this->rules);

            if ($validation->fails()) {
                throw new CreateUserViaFormException($validation->messages(), $validation);
            }
        }
    }