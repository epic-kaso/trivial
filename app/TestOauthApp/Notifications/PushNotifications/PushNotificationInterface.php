<?php

    namespace TestOauthApp\Notifications\PushNotifications;


    use TestOauthApp\Notifications\PushNotifications\Events\PushNotificationEvent;

    interface PushNotificationInterface
{

	public function notify(PushNotificationEvent $event);

}