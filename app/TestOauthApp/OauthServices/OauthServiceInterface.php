<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 12:04 PM
     */

    namespace TestOauthApp\OauthServices;


    use User;

    interface OauthServiceInterface
    {
        public function getOauthService();

        public function getOauthUser($token);

        public function getOauthRequestUri();

        public function makeOauthUser(User $user, $oauthUser);
    }