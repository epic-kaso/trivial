<?php

    use TestOauthApp\Command\UserCreation\Exceptions\CreateUserViaFormException;
    use TestOauthApp\Command\UserCreation\Form\CreateUserViaFormCommand;

    class RegisterController extends \BaseController
    {


        function __construct()
        {
            $this->beforeFilter('guest');
        }

        public function getShowRegister()
        {
            return View::make('auth.register');
        }

        public function postProcessRegister()
        {
            try {

                $user = $this->execute(CreateUserViaFormCommand::class);
                Auth::login($user);

                return Redirect::home();

            } catch (CreateUserViaFormException $ex) {
                return Redirect::back()->withInput()->withErrors($ex->getErrorProvider());
            }
        }
    }
