<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 7:38 PM
     */

    namespace TestOauthApp\Services\File;


    use App;
    use Config;
    use GrahamCampbell\Flysystem\FlysystemManager;

    class FileDownloadService
    {

        protected $flysystem;

        function __construct(FlysystemManager $flysystem)
        {
            $this->flysystem = App::environment() == 'local' ?
                $flysystem->connection('local') : $flysystem->connection(Config::get('my-config.production-storage'));
        }

        public function download($fileName)
        {
            return $this->flysystem->read($fileName);
        }
    }