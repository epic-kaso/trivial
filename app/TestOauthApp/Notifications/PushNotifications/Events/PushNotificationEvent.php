<?php

    namespace TestOauthApp\Notifications\PushNotifications\Events;

abstract class PushNotificationEvent
{

	private $eventMessage = [];


	public abstract function getName();

	public abstract function getChannel();

	public function getMessage()
	{

		return $this->eventMessage;
	}

	public function addMessage($key,$value)
	{

		$this->eventMessage[$key] = $value;
	}

	public function setMessage(array $message)
	{

		$this->eventMessage = $message;
	}
}