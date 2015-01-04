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
            'file' => 'required|mimes:jpeg,bmp,png,zip,rar,mpga,7zip,pdf,doc,docx,ppt,pptx,xsl,xslx'
        ];

        public function validate(CreateUserFileCommand $command)
        {
            $validation = \Validator::make(
                [
                    'file' => $command->uploadedFile
                ], $this->rules);

            if ($validation->fails()) {
                throw new CreateUserFileException($validation->messages(), $validation);
            }
        }

    }