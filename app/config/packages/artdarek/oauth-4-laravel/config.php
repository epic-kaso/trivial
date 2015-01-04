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
                'client_id'     => '288126571362674',
                'client_secret' => 'b2ad741e8adc9c8e499958dfb9e8676b',
                'scope'         => array('email'),
            ),
            'Google'   => array(
                'client_id'     => '468737018255-02b86ae4ebi4ee6iqti2ju8vv8lddk25.apps.googleusercontent.com',
                'client_secret' => 'HHSTCn3hj4OBkTzjtwYa8ViA',
                'scope'         => array('userinfo_email', 'userinfo_profile'),
            ),
            'Twitter'  => array(
                'client_id'     => 'Your Twitter client ID',
                'client_secret' => 'Your Twitter Client Secret',
                // No scope - oauth1 doesn't need scope
            ),
        )

    );