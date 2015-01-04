<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:54 PM
     */

    namespace TestOauthApp\Repository;


    use TestOauthApp\Events\User\UserFileCreated;
    use TestOauthApp\Services\File\FileUploadService;
    use User;
    use UserFile;

    class UserFileRepository
    {


        /**
         * @var FileUploadService
         */
        private $fileUploadService;

        function __construct(FileUploadService $fileUploadService)
        {
            $this->fileUploadService = $fileUploadService;
        }

        public function createFile(
            $originalFileName,
            $originalExtension,
            $newfilename,
            $newDirectory,
            $currentfilepath,
            $fileSize,
            User $currentUser
        )
        {
            $response = $this->fileUploadService->upload($currentfilepath, $newfilename, $newDirectory);

            $Resultfile = UserFile::create(
                [
                    'user_id'   => $currentUser->id,
                    'key'       => $response['key'],
                    'name'      => $originalFileName,
                    'type'      => $originalExtension,
                    'size'      => $fileSize,
                    'file_path' => $response['path'],
                ]);

            $Resultfile->raise(new UserFileCreated($Resultfile));

            return $Resultfile;
        }

        public function getNewUniqueFileName($fileExtension)
        {
            return time() . '.' . $fileExtension;
        }

        public function all(User $user)
        {
            return UserFile::whereUserId($user->id)->get();
        }
    }