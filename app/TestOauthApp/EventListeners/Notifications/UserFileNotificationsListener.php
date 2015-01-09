<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/9/2015
     * Time: 12:31 PM
     */

    namespace TestOauthApp\EventListeners\Notifications;

    use Laracasts\Commander\Events\EventListener;
    use TestOauthApp\Notifications\PushNotifications\PushNotificationInterface;

    class UserFileNotificationsListener extends EventListener
    {
        /**
         * @var PushNotificationInterface
         */
        private $pushNotification;

        function __construct(PushNotificationInterface $pushNotification)
        {
            $this->pushNotification = $pushNotification;
        }

        public function whenUserFileSavedSuccessfully($event)
        {
            $userfile = $event->getFile();
            $this->pushNotification->notify($userfile);
        }
    }