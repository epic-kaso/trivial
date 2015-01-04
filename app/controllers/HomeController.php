<?php

    use TestOauthApp\Repository\UserFileRepository;

    class HomeController extends BaseController
    {


        /**
         * @var UserFileRepository
         */
        private $userFileRepository;

        function __construct(UserFileRepository $userFileRepository)
        {
            $this->userFileRepository = $userFileRepository;
        }

        public function showWelcome()
        {
            $files = $this->userFileRepository->all(Auth::user());

            return View::make('pages.welcome', compact('files'));
        }

    }
