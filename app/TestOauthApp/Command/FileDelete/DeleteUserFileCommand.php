<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:54 AM
     */

    namespace TestOauthApp\Command\FileDelete;


    use UserFile;

    class DeleteUserFileCommand
    {

        public $userFile;

        function __construct(UserFile $userFile)
        {
            $this->userFile = $userFile;
        }
    }