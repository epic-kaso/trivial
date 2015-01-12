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
    use Log;
    use Pusher;
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

            $this->setupPushNotification();
            $this->setupPaperTrail();

        }

        private function setupPushNotification()
        {
            $this->app->singleton('Pusher', function () {
                $appId = Config::get('services.pusher.app_id');
                $appKey = Config::get('services.pusher.app_key');
                $appSecret = Config::get('services.pusher.app_secret');

                return new Pusher($appId, $appKey, $appSecret);
            });


            $this->app->bind(
                'TestOauthApp\Notifications\PushNotifications\PushNotificationInterface',
                'TestOauthApp\Notifications\PushNotifications\PusherNotification'
            );
        }

        private function setupPaperTrail()
        {
            $monolog = Log::getMonolog();
            $syslog = new \Monolog\Handler\SyslogHandler('papertrail');
            $formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
            $syslog->setFormatter($formatter);
            $monolog->pushHandler($syslog);
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