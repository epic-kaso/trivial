<?php
    use TestOauthApp\Services\File\Size;

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:51 PM
     */
    class StorageSpacesSeed extends Seeder
    {

        public function run()
        {
            Eloquent::unguard();
            SellableStorageSpace::truncate();

            $space = new SellableStorageSpace();
            $space->name = "1 Gigabyte";
            $space->description = "One Gigabyte of storage space";
            $space->price = 1000;
            $space->size = Size::Gigabyte(1)->getBytes();

            $space->save();

            $space = new SellableStorageSpace();
            $space->name = "2 Gigabyte";
            $space->description = "Two Gigabyte of storage space";
            $space->price = 1500;
            $space->size = Size::Gigabyte(2)->getBytes();

            $space->save();

            $space = new SellableStorageSpace();
            $space->name = "4 Gigabyte";
            $space->description = "Four Gigabyte of storage space";
            $space->price = 2500;
            $space->size = Size::Gigabyte(4)->getBytes();

            $space->save();


            $space = new SellableStorageSpace();
            $space->name = "8 Gigabyte";
            $space->description = "Eight Gigabyte of storage space";
            $space->price = 4000;
            $space->size = Size::Gigabyte(4)->getBytes();

            $space->save();

        }
    }