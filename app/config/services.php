<?php

    return array(

        /*
        |--------------------------------------------------------------------------
        | Third Party Services
        |--------------------------------------------------------------------------
        |
        | This file is for storing the credentials for third party services such
        | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
        | default location for this type of information, allowing packages
        | to have a conventional place to find your various credentials.
        |
        */

        'mailgun'  => array(
            'domain' => '',
            'secret' => '',
        ),

        'mandrill' => array(
            'secret' => 'LKeWp7K5lPH7t4yh0_fcRQ'//'XZ6K0JEmpINZY4sw6_1F2g',
        ),

        'stripe'   => array(
            'model'  => 'User',
            'secret' => '',
        ),
        'pusher' => array(
	        'app_id'=>'102645',
	        'app_key'=> '6278ac0fb0e0438da832',
        	'app_secret' => '9da18a0889b1920977e0'
		)

    );
