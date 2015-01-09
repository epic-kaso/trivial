<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/9/2015
     * Time: 12:21 PM
     */

    namespace TestOauthApp\Notifications\PushNotifications\Events\File;


    use UserFile;

    class UserFileReadyPushNotificationEvent extends UserFilePushNotificationEvent
    {

        public static $name = "file_ready_event";

        private $userFile;

        public function __construct(UserFile $userFile)
        {

            $this->userFile = $userFile;
            $this->setMessage([
                    'file_ready'    => $userFile->isReady(),
                    'file_hashcode' => $userFile->hashcode,
                    'file'          => $userFile
                ]
            );
        }

        public function getName()
        {
            return static::$name;
        }
    }