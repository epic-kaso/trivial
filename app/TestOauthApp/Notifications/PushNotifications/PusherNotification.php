<?php

    namespace TestOauthApp\Notifications\PushNotifications;

    use Pusher;
    use TestOauthApp\Notifications\PushNotifications\Events\PushNotificationEvent;

class PusherNotification implements PushNotificationInterface
{


	private $pusher;

    public function __construct(Pusher $pusher)
	{
		$this->pusher = $pusher;
	}

	public function notify(PushNotificationEvent $event)
	{
        $this->pusher->trigger($event->getChannel(), $event->getName(), $event->getMessage());
	}

}