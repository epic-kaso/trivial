<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/5/2015
     * Time: 12:55 AM
     */

    namespace TestOauthApp\Command\FileDelete;


    use Laracasts\Commander\Events\EventGenerator;
    use TestOauthApp\Command\BaseCommandHandler;
    use TestOauthApp\Events\User\UserFileDeleted;

    class DeleteUserFileCommandHandler extends BaseCommandHandler
    {

        use EventGenerator;

        /**
         * Handle the command
         *
         * @param $command
         * @return mixed
         */
        public function handle($command)
        {
            $file = $command->userFile;
            $event = new UserFileDeleted($file->size, $file->path);

            $response = $file->deleteMe();
            $this->raise($event);
            $this->dispatchEventsFor($this);

            return $response;
        }
    }