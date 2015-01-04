<?php namespace TestOauthApp\Command\FileDownload;

use UserFile;

class DownloadUserFileCommand
{
    /**
     * @var UserFile
     */
    public $userFile;

    /**
     * @param UserFile $userFile
     */
    public function __construct(UserFile $userFile)
    {
        $this->userFile = $userFile;
    }

}