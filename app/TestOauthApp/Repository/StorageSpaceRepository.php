<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:17 PM
     */

    namespace TestOauthApp\Repository;


    use TestOauthApp\Events\User\UserStorageSizeIncreased;
    use TestOauthApp\Services\File\Size;
    use User;

    class StorageSpaceRepository
    {

        public function addStorageSpaceToUser(Size $size, User $user)
        {
            $user->storage->increaseStorageSize($size);
            $user->raise(new UserStorageSizeIncreased($size, $user));

            return $user;
        }
    }