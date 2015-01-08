<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 6:40 PM
     */

    namespace TestOauthApp\Command\FileCreation;


    class CreateUserFileValidator
    {

        public $rules = [
            'file' => 'required|mimes:jpeg,bmp,png,zip,rar,mpga,mp3,mp4,wav,aac,m4a,m3u,audio/*,video/*,7zip,pdf,doc,docx,ppt,pptx,xsl,xslx'
        ];
        private $exts = "jpeg,bmp,png,zip,rar,mpga,mp3,mp4,wav,aac,m4a,m3u,audio/*,video/*,7zip,pdf,doc,docx,ppt,pptx,xsl,xslx";

        public function validate(CreateUserFileCommand $command)
        {
            $varA = explode(',', $this->exts);
            $validation = \Validator::make(
                [
                    'file' => $command->uploadedFile
                ], $this->rules);

            if ($validation->fails() && !in_array($command->uploadedFile->getClientOriginalExtension(), $varA)) {
                throw new CreateUserFileException($validation->messages(), $validation);
            }
        }

    }