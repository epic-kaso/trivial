<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/2/2015
     * Time: 4:58 PM
     */

    namespace TestOauthApp;


    class OauthService
    {
        /**
         * @var \Artdarek\OAuth\OAuth
         */
        private $OAuth;

        function __construct(\Artdarek\OAuth\OAuth $OAuth)
        {
            $this->OAuth = $OAuth;
        }

        public function getGoogleRequestUrl()
        {
            return 'https://www.googleapis.com/oauth2/v1/userinfo';
        }

        public function getFacebookRequestUrl()
        {
            return '/me';
        }

        public function getFacebookService()
        {
            return $this->OAuth->consumer('Facebook');
        }

        public function getGoogleService()
        {
            return $this->OAuth->consumer('Google');
        }
    }
