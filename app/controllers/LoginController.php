<?php

    use TestOauthApp\Command\UserCreation\Exceptions\CreateUserViaOauthServiceException;
    use TestOauthApp\Command\UserCreation\Oauth\CreateUserViaOauthServiceCommand;
    use TestOauthApp\OauthService;
    use TestOauthApp\OauthServices\FacebookOauthService;
    use TestOauthApp\OauthServices\GoogleOauthService;
    use TestOauthApp\Repository\UserRepository;

    class LoginController extends \BaseController
    {
        protected $validation_rules = [
            'email'       => 'required|email',
            'password'    => 'required',
            'remember_me' => ''
        ];

        /**
         * @var OauthService
         */
        private $oauthService;
        /**
         * @var UserRepository
         */
        private $userRepository;

        function __construct(OauthService $oauthService, UserRepository $userRepository)
        {
            $this->oauthService = $oauthService;
            $this->userRepository = $userRepository;

            $this->beforeFilter('guest');
        }

        public function getShowLogin()
        {
            return View::make('auth.login');
        }

        public function loginWithFacebook()
        {
            $code = Input::get('code');
            $oauthProvider = App::make(FacebookOauthService::class);

            return $this->processOauthLogin($oauthProvider, $code);
        }

        /**
         * @param $oauthProvider
         * @param $code
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function processOauthLogin($oauthProvider, $code)
        {
            try {
                $user = $this->execute(
                    CreateUserViaOauthServiceCommand::class,
                    ['oauthProvider' => $oauthProvider, 'code' => $code]
                );
                Auth::login($user);

                return Redirect::home();

            } catch (CreateUserViaOauthServiceException $e) {
                return Redirect::to($e->getRedirectUrl());
            }
        }

        public function loginWithGoogle()
        {
            $code = Input::get('code');
            $oauthProvider = App::make(GoogleOauthService::class);

            return $this->processOauthLogin($oauthProvider, $code);
        }

        public function postProcessLogin()
        {
            $data = Input::only(array_keys($this->validation_rules));
            $validation = Validator::make($data, $this->validation_rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            }

            if (Auth::attempt($data, $data['remember_me'])) {
                return Redirect::intended(Redirect::back());
            }

            return Redirect::back()->withInput()->withError('Invalid Email/Password');
        }
    }
