<?php

    use Illuminate\Routing\Controller;
    use LucaDegasperi\OAuth2Server\Authorizer;

    class OAuthController extends Controller
    {
        protected $authorizer;

        public function __construct(Authorizer $authorizer)
        {
            $this->authorizer = $authorizer;

            $this->beforeFilter('auth', ['only' => ['getAuthorize', 'postAuthorize']]);
            $this->beforeFilter('csrf', ['only' => 'postAuthorize']);
            $this->beforeFilter('check-authorization-params', ['only' => ['getAuthorize', 'postAuthorize']]);
        }

        public function postAccessToken()
        {
            return Response::json($this->authorizer->issueAccessToken());
        }

        public function getAuthorize()
        {
            return View::make('oauth.authorization-form', $this->authorizer->getAuthCodeRequestParams());
        }

        public function postAuthorize()
        {
            // get the user id
            $params['user_id'] = Auth::user()->id;

            $redirectUri = '';

            if (Input::get('approve') !== NULL) {
                $redirectUri = $this->authorizer->issueAuthCode('user', $params['user_id'], $params);
            }

            if (Input::get('deny') !== NULL) {
                $redirectUri = $this->authorizer->authCodeRequestDeniedRedirectUri();
            }

            return Redirect::to($redirectUri);
        }
    }
