<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 7:38 PM
     */

    namespace TestOauthApp\Services\File;


    class FileDownloadService extends FileService
    {


        public function download($fileName)
        {
            return $this->flysystem->read($fileName);
        }
    }