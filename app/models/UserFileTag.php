<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/9/2015
     * Time: 12:50 AM
     */
    class UserFileTag extends BaseModel
    {

        protected $table = "user_file_tags";

        public function user()
        {
            return $this->belongsTo('User');
        }

        public function userFile()
        {
            return $this->belongsTo('UserFile');
        }

    }