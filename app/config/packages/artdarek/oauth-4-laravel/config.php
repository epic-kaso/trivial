<?php

    return array(

        /*
        |--------------------------------------------------------------------------
        | oAuth Config
        |--------------------------------------------------------------------------
        */

        /**
         * Storage
         */
        'storage'   => 'Session',

        /**
         * Consumers
         */
        'consumers' => array(

            /**
             * Facebook
             */
            'Facebook' => array(
                'client_id'     => getenv('FACEBOOK_APP_KEY'),
                'client_secret' => getenv('FACEBOOK_APP_SECRET'),
                'scope'         => array('email'),
            ),
            'Google'   => array(
                'client_id'     => getenv('GOOGLE_APP_KEY'),
                'client_secret' => getenv('GOOGLE_APP_SECRET'),
                'scope'         => array('userinfo_email', 'userinfo_profile'),
            ),
            'Twitter'  => array(
                'client_id'     => 'Your Twitter client ID',
                'client_secret' => 'Your Twitter Client Secret',
                // No scope - oauth1 doesn't need scope
            ),
        )

    );