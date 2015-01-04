<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 12:09 PM
     */

    namespace TestOauthApp\ServiceProviders;


    use Config;
    use Event;
    use Illuminate\Support\ServiceProvider;
    use TestOauthApp\OauthServices\FacebookOauthService;
    use TestOauthApp\OauthServices\GoogleOauthService;

    class Bootstrap extends ServiceProvider
    {

        public function boot()
        {
            $listeners = Config::get('my-config.listeners');

            foreach ($listeners as $listener) {
                Event::listen('TestOauthApp.*', $listener);
            }

            Event::listen('auth.login', function ($user) {

            });
        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {

            $oauth = $this->app->make('TestOauthApp\OauthService');

            $this->app->bind('TestOauthApp\OauthServices\FacebookOauthService', function () use ($oauth) {
                $service = $oauth->getFacebookService();

                return new FacebookOauthService($service, $oauth->getFacebookRequestUrl());
            });

            $this->app->bind('TestOauthApp\OauthServices\GoogleOauthService', function () use ($oauth) {
                $service = $oauth->getGoogleService();

                return new GoogleOauthService($service, $oauth->getGoogleRequestUrl());
            });

        }
    }