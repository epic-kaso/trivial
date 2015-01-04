<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 12:06 PM
     */

    namespace TestOauthApp\OauthServices;


    use User;

    class FacebookOauthService implements OauthServiceInterface
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
            return $this->getFacebookUser($token);
        }

        private function getFacebookUser($token)
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
            return $this->makeFacebookUser($user, $oauthUser);
        }

        private function makeFacebookUser(User $user, $fbUser)
        {
            $newUser = $user;
            if (!$newUser->isFacebookOauthEnabled()) {
                $newUser->enableFacebookOauth($fbUser['oauth_token']);
            }

            return $newUser;
        }
    }