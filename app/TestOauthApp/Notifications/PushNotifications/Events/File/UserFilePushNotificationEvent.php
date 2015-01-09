<?php 

namespace 'TestOauthApp\Notifications\PushNotifications\Events\File';

abstract class UserFilePushNotificationEvent extends PushNotificationEvent
{

	public static $channel = "user_files_channel";


	public function getChannel(){

		return static::$channel;

	}

}