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
            $active = 'all-files';
            $title = "My Files";

            return View::make('pages.welcome', compact('files', 'active', 'title'));
        }

        public function showFilesForSale()
        {
            $files = $this->userFileRepository->filesForSale(Auth::user());
            $active = 'files-for-sale';
            $title = "Files for sale";

            return View::make('pages.welcome', compact('files', 'active', 'title'));
        }

    }
