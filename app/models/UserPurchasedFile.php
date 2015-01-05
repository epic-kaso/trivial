<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 7:52 PM
     */
    class UserPurchasedFile extends BaseModel
    {

        protected $table = "user_purchased_files";

        public function user()
        {
            return $this->belongsTo('User');
        }

        public function userFile()
        {
            return $this->belongsTo('UserFile');
        }

    }