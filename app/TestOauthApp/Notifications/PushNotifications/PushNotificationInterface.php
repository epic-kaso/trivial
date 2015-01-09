<?php

namespace 'TestOauthApp\Notifications\PushNotifications';

use Events\PushNotificationEvent;

interface PushNotification
{

	public function notify(PushNotificationEvent $event);

}