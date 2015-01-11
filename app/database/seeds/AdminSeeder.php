<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/11/2015
     * Time: 1:55 PM
     */
    class AdminSeeder extends Seeder
    {

        public function run()
        {
            Eloquent::unguard();

            User::firstOrCreate(['email' => 'admin@kaso.co', 'password' => 'password', 'type' => 'admin']);

        }

    }