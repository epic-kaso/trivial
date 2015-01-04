<?php namespace TestOauthApp\Command\FileCreation;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use User;

class CreateUserFileCommand
{
    /**
     * @var UploadedFile
     */
    public $uploadedFile;
    /**
     * @var User
     */
    public $currentUser;

    /**
     * @param UploadedFile $uploadedFile
     * @param User $currentUser
     */
    public function __construct(UploadedFile $uploadedFile, User $currentUser)
    {
        $this->uploadedFile = $uploadedFile;
        $this->currentUser = $currentUser;
    }

}