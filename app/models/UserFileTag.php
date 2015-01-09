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

        public static function createTagsFromString($tags,$file_id,$user_id)
        {
            $tags = explode(',',$tags);
            foreach($tags as $tag){
                static::create(['tag'=> $tag,'user_file_id' => $file_id,'user_id' => $user_id]);
            }
        }

        public function user()
        {
            return $this->belongsTo('User');
        }

        public function userFile()
        {
            return $this->belongsTo('UserFile');
        }

    }