<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 1:13 PM
     */

    return [
        'listeners'          => [
            'TestOauthApp\EventListeners\User\UserEventsListener'
        ],
        'production-storage' => 'awss3'
    ];