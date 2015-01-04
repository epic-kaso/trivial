<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 12:29 PM
     */

    namespace TestOauthApp\OauthServices;


    use User;

    class GoogleOauthService implements OauthServiceInterface
    {

        /**
         * @var
         */
        private $oauthService;
        /**
         * @var
         */
        private $requestUri;

        function __construct($oauthService, $requestUri)
        {
            $this->oauthService = $oauthService;
            $this->requestUri = $requestUri;
        }

        public function getOauthService()
        {
            return $this->oauthService;
        }

        public function getOauthUser($token)
        {
            return $this->getGoogleUser($token);
        }

        private function getGoogleUser($token)
        {
            $fbUser = json_decode(
                $this->oauthService->request(
                    $this->getOauthRequestUri()
                ), TRUE);

            $fbUser['oauth_token'] = $token;

            return $fbUser;
        }

        public function getOauthRequestUri()
        {
            return $this->requestUri;
        }

        public function makeOauthUser(User $user, $oauthUser)
        {
            return $this->makeGoogleUser($user, $oauthUser);
        }

        private function makeGoogleUser(User $user, $fbUser)
        {
            if (!$user->isGoogleOauthEnabled()) {
                $user->enableGoogleOauth($fbUser['oauth_token']);
            }

            return $user;
        }
    }