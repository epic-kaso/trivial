<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:38 PM
     */

    namespace TestOauthApp\Services\File;

    use Laracasts\Commander\Events\DispatchableTrait;
    use Laracasts\Commander\Events\EventGenerator;
    use TestOauthApp\Events\File\UserFileSavedSuccessfully;
    use UserFile;

    class FileUploadService extends FileService
    {
        use EventGenerator;
        use DispatchableTrait;

        public function upload(UserFile $file, $currentFilePath, $newFilename, $newDirectory)
        {
            $userFileId = $file->id;
            \Queue::push('TestOauthApp\Services\File\FileUploadService',
                compact('currentFilePath', 'newFilename', 'newDirectory', 'userFileId'));
        }

        public function fire($job, $data)
        {
            $currentFilePath = $data['currentFilePath'];
            $newFilename = $data['newFilename'];
            $newDirectory = $data['newDirectory'];
            $userFile = UserFile::find($data['userFileId']);
            $path = $newDirectory . '/' . $newFilename;

            $this->flysystem->write(
                $path,
                \File::get($currentFilePath),
                ['visibility' => 'private']
            );

            $userFile->file_path = $path;
            $userFile->active = TRUE;
            $userFile->save();

            $this->raise(new UserFileSavedSuccessfully($newFilename));
            $job->delete();
            $this->dispatchEventsFor($this);
            \File::delete($currentFilePath);
        }
    }