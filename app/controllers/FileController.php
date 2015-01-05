<?php

    use TestOauthApp\Command\FileCreation\CreateUserFileCommand;
    use TestOauthApp\Command\FileCreation\CreateUserFileException;
    use TestOauthApp\Command\FileDelete\DeleteUserFileCommand;
    use TestOauthApp\Command\FileDownload\DownloadUserFileCommand;

    class FileController extends \BaseController
    {


        protected $currentUser;

        function __construct()
        {
            $this->beforeFilter('auth');
            $this->beforeFilter('storage-size', ['only' => 'store']);
            $this->currentUser = Auth::user();
        }


        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            //
        }


        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store()
        {
            try {
                $this->execute(CreateUserFileCommand::class,
                    [
                        'currentUser'  => $this->currentUser,
                        'uploadedFile' => Input::file('file')
                    ]);

                return Redirect::home()->withStatus('Uploaded Successfully');
            } catch (CreateUserFileException $ex) {
                return Redirect::back()->withInput()->withErrors($ex->getErrorProvider());
            }
        }


        /**
         * Display the specified resource.
         *
         * @param UserFile $file
         * @return Response
         * @internal param int $id
         */
        public function show(UserFile $file)
        {
            //
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return Response
         */
        public function edit(UserFile $file)
        {
            //
        }


        /**
         * Update the specified resource in storage.
         *
         * @param  int $id
         * @return Response
         */
        public function update(UserFile $file)
        {

        }


        /**
         * Remove the specified resource from storage.
         *
         * @param UserFile $file
         * @return Response
         * @internal param int $id
         */
        public function destroy(UserFile $file)
        {
            //dd(UserFile::destroy($file->id));
            try {
                $this->execute(DeleteUserFileCommand::class, ['userFile' => $file]);

                return Redirect::home();
            } catch (Exception $ex) {
                dd($ex->getMessage());
            }

        }

        public function download(UserFile $file)
        {

            $result = $this->execute(DownloadUserFileCommand::class, ['userFile' => $file]);

            return Response::make($result, 200, [
                'Content-Description' => 'File Transfer',
                'Content-Type'        => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename=' . basename($file->name),
                'Expires'             => '0',
                'Cache-Control'       => 'must-revalidate',
                'Pragma'              => 'public',
                'Content-Length'      => $file->size
            ]);
        }

        public function makeSellable(UserFile $file)
        {

            if ($file->isSellable())
                return Redirect::back();

            $price = Input::get('price');

            $validation = Validator::make(Input::only(['price']), ['price' => 'required|numeric']);

            if ($validation->fails())
                return Redirect::back()->withInput()->withErrors($validation);
            $file->makeSellable(doubleval($price));

            return Redirect::home();
        }
    }
