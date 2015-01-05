<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:49 PM
     */
    class SellableStorageSpace extends BaseModel
    {
        protected $table = "sellable_storage_spaces";
        protected $guarded = ['id', 'hashcode', 'price'];

        public function getPrice()
        {
            return $this->price;
        }
    }