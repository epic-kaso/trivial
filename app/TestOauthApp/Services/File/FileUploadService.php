<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:38 PM
     */

    namespace TestOauthApp\Services\File;


    use App;
    use Config;
    use GrahamCampbell\Flysystem\FlysystemManager;

    class FileUploadService
    {


        protected $flysystem;

        function __construct(FlysystemManager $flysystem)
        {
            $this->flysystem = App::environment() == 'local' ?
                $flysystem->connection('local') : $flysystem->connection(Config::get('my-config.production-storage'));
        }

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