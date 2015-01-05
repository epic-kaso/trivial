<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:38 PM
     */

    namespace TestOauthApp\Services\File;


    class FileUploadService extends FileService
    {


        public function upload($currentFilePath, $newFilename, $newDirectory)
        {

            $this->flysystem
                ->write(
                    $newDirectory . '/' . $newFilename,
                    \File::get($currentFilePath),
                    ['visibility' => 'private']
                );

            return ['key' => $newFilename, 'path' => $newDirectory . '/' . $newFilename];
        }

    }