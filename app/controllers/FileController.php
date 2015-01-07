<?php

    use TestOauthApp\Command\FileCreation\CreateUserFileCommand;
    use TestOauthApp\Command\FileCreation\CreateUserFileException;
    use TestOauthApp\Command\FileDelete\DeleteUserFileCommand;
    use TestOauthApp\Command\FileDownload\DownloadUserFileCommand;
    use TestOauthApp\Services\File\FileDownloadService;

    class FileController extends \BaseController
    {


        protected $currentUser;
        /**
         * @var FileDownloadService
         */
        private $downloadService;

        function __construct(FileDownloadService $downloadService)
        {
            $this->beforeFilter('auth', ['except' => 'download']);
            $this->beforeFilter('storage-size', ['only' => 'store']);
            $this->currentUser = Auth::user();
            $this->downloadService = $downloadService;
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
                if (Request::ajax())
                    return Response::json(['error' => $ex->getMessage()], 400);
                else
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
            $rules = ['g-recaptcha-response' => 'required|recaptcha'];

            if (!Auth::check()) {
                if (Agent::isMobile()) {
                    $result = Input::get('captcha-result');
                    $validated = $result == Session::get('captcha-result');

                    if (!$validated) {
                        return Redirect::back()->withError("Please Re-Validate Captcha");
                    }
                } else {
                    $validation = Validator::make(Input::all(), $rules);
                    if ($validation->fails()) {
                        return Redirect::back()->withErrors($validation);
                    }
                }

            }

            if ((Auth::check() && $file->belongsToUser(Auth::user())) || $file->isFree()) {
                $result = $this->execute(DownloadUserFileCommand::class, ['userFile' => $file]);

                return $this->downloadService->makeDownloadResponse($file, $result);
            }
            App::abort(404);
        }

        public function renameFile(UserFile $file)
        {
            $name = Input::get('newName');

            $validation = Validator::make(Input::only(['newName']), ['newName' => 'required']);

            if ($validation->fails())
                return Redirect::back()->withInput()->withErrors($validation);

            $file->rename($name);

            Session::flash('success', 'Successfully renamed file.');

            if (Request::ajax()) {
                return Response::json(['success' => TRUE]);
            } else {
                return Redirect::home();
            }
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

            $type = $file->isFree() ? 'Sharing' : 'Selling';

            $message = 'Successfully Enable ' . $type . ' Feature for' . $file->name;

            return Redirect::home()->withSuccess($message);
        }

    }
