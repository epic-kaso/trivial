<?php namespace TestOauthApp\Command\FileCreation;

use TestOauthApp\Command\BaseCommandHandler;
use TestOauthApp\Repository\UserFileRepository;

class CreateUserFileCommandHandler extends BaseCommandHandler
{


    /**
     * @var UserFileRepository
     */
    private $userFileRepository;

    function __construct(UserFileRepository $userFileRepository)
    {
        $this->userFileRepository = $userFileRepository;
    }


    /**
     * Handle the command.
     *
     * @param object $command
     * @return mixed
     */
    public function handle($command)
    {
        $file = $command->uploadedFile;

        $originalFileName = $file->getClientOriginalName();
        $originalExtension = $file->getClientOriginalExtension();
        $newDirectory = $command->currentUser->getDirectory();
        $size = $file->getSize();
        $newFilename = $this->userFileRepository->getNewUniqueFileName($originalExtension);
        $newfile = $file->move(storage_path().'/files/temp'), $newFilename);

        $userFile = $this->userFileRepository
            ->createFile(
                $originalFileName,
                $originalExtension,
                $newFilename,
                $newDirectory,
                $newfile->getRealPath(),
                $size,
                $command->currentUser
            );
        $this->dispatchEventsFor($userFile);

        return $userFile;
    }
}