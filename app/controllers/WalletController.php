<?php

    class WalletController extends \BaseController
    {

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $active = 'wallet';
            $title = "Wallet";

            return View::make('wallet.index', compact('active', 'title'));
        }
    }
