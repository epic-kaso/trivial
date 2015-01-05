<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:23 PM
     */

    namespace TestOauthApp\Events\User;


    use TestOauthApp\Services\File\Size;
    use User;

    class UserStorageSizeIncreased
    {

        protected $size;
        protected $user;

        function __construct(Size $size, User $user)
        {
            $this->size = $size;
            $this->user = $user;
        }

        /**
         * @return Size
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * @return User
         */
        public function getUser()
        {
            return $this->user;
        }

    }