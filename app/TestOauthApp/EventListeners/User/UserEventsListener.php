<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:15 PM
     */

    namespace TestOauthApp\EventListeners\User;


    use Laracasts\Commander\Events\EventListener;
    use TestOauthApp\Services\File\Size;

    class UserEventsListener extends EventListener
    {

        public function whenUserRegisterEvent($event)
        {
            $user = $event->getUser();
            $storage = new \Storage();
            $storage->setTotalStorage(Size::Gigabyte(1));
            $user->storage()->save($storage);
        }

        public function whenUserFileCreated($event)
        {
            $user = \Auth::user();
            $user->storage->increaseUsedSize(Size::Bytes($event->getUserFile()->size));
            $user->save();
        }

        public function whenUserFileDeleted($event)
        {
            $user = \Auth::user();
            $user->storage->deductUsedSize(Size::Bytes($event->getUserFileSize()));
            $user->save();
        }
    }