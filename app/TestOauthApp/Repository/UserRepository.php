<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/2/2015
     * Time: 5:11 PM
     */

    namespace TestOauthApp\Repository;


    use TestOauthApp\Events\User\UserRegisterEvent;

    class UserRepository
    {

        private $user;

        function __construct(\User $user)
        {
            $this->user = $user;
        }

        /**
         * @param array $details
         * @return static
         */
        public function createOauthUser(array $details)
        {
            $user = $this->userFirstOrCreate(['email' => $details['email']]);

            if (!$user->hasPassword()) {
                $user->password = \Str::random(10);
            }

            if (!$user->hasHashcode()) {
                $user->hashcode = rand(10000000, 99999999);
            }

            $user->save();

            return $user;
        }

        private function userFirstOrCreate($attributes)
        {
            if (!is_null($instance = $this->user->where($attributes)->first())) {
                return $instance;
            }
            $user = $this->user->create($attributes);
            $user->raise(new UserRegisterEvent($user));

            return $user;
        }

        public function createFormUser($email, $password)
        {
            $user = $this->user->create(['email' => $email, 'password' => $password]);
            $user->raise(new UserRegisterEvent($user));

            return $user;
        }
    }