<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 7:38 PM
     */

    namespace TestOauthApp\Services\File;


    use ZipArchive;

    class FileDownloadService extends FileService
    {


        public function download($fileName)
        {
            return $this->flysystem->read($fileName);
        }

        public function downloadZip($filePath, $fileName)
        {
            $content = $this->flysystem->read($filePath);
            $dirName = storage_path('files/temp');
            if (!file_exists($dirName))
                \File::makeDirectory($dirName);

            $path = $dirName . '/' . time() . $fileName;

            \File::put($path, $content);
            return $this->prepareArchive($path, $fileName);
        }


        private function prepareArchive($filePath, $fileName)
        {
            $dirName = storage_path('files/temp');

            if (!file_exists($dirName))
                \File::makeDirectory($dirName);

            $zipFileName = time() . '.zip';
            $zip = new ZipArchive;
            if ($zip->open($dirName . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->addFile($filePath, $fileName);
                $zip->close();

                return $dirName . '/' . $zipFileName;
            } else {
                throw new \Exception('Could not create Zip');
            }
        }
    }