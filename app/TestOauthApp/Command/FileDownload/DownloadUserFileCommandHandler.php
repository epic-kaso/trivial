<?php namespace TestOauthApp\Command\FileDownload;

use Laracasts\Commander\CommandHandler;
use TestOauthApp\Services\File\FileDownloadService;
use TestOauthApp\Services\File\FileUploadService;

class DownloadUserFileCommandHandler implements CommandHandler
{


    /**
     * @var FileUploadService
     */
    private $fileDownloadService;

    function __construct(FileDownloadService $fileDownloadService)
    {
        $this->fileDownloadService = $fileDownloadService;
    }


    /**
     * Handle the command.
     *
     * @param object $command
     * @return mixed
     */
    public function handle($command)
    {
        $userFile = $command->userFile;
        $data = $this->fileDownloadService->download($userFile->getPath());

        return $data;
    }

}