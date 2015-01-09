<?php 

namespace 'TestOauthApp\Notifications\PushNotifications';

class PusherNotification implements PushNotificationInterface
{


	private $pusher;

	public function __construct(\Pusher $pusher)
	{
		$this->pusher = $pusher;
	}

	public function notify(PushNotificationEvent $event)
	{
		$pusher->trigger($event->getChannel(),$event->getName(),$event->getMessage());
	}

}