<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 1:30 AM
     */

    namespace TestOauthApp\Services\File;


    use App;
    use Config;
    use GrahamCampbell\Flysystem\FlysystemManager;

    class FileService
    {

        protected $flysystem;

        function __construct(FlysystemManager $flysystem)
        {
            $this->flysystem = App::environment() == 'local' ?
                $flysystem->connection('local') : $flysystem->connection(Config::get('my-config.production-storage'));
        }

        public function deleteFile($path)
        {
            return $this->flysystem->delete($path);
        }
    }