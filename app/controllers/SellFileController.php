<?php

    use TestOauthApp\Command\FilePurchase\BuyFileViaCreditCardCommand;
    use TestOauthApp\Command\FilePurchase\TransactionNotApprovedException;

    class SellFileController extends \BaseController
    {

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
            //
        }


        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return Response
         */
        public function show(UserFile $file)
        {
            return View::make('sell_file.show', compact('file'));
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return Response
         */
        public function edit($id)
        {
            //
        }


        /**
         * Update the specified resource in storage.
         *
         * @param  int $id
         * @return Response
         */
        public function update($id)
        {
            //
        }


        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

        public function sellSuccess(UserFile $userFile)
        {
            $response = Input::get('xmlmsg');

            try {
                return $this->execute(BuyFileViaCreditCardCommand::class,
                    [
                        'creditCardTransactionResponse' => $response,
                        'userFile'                      => $userFile
                    ]);
            } catch (TransactionNotApprovedException $ex) {
                return Redirect::route('home')->withError('Failed to Buy Storage');
            }

        }

        public function sellFailure(UserFile $userFile)
        {
            $response = Input::get('xmlmsg');

            try {
                $this->execute(BuyFileViaCreditCardCommand::class,
                    [
                        'creditCardTransactionResponse' => $response,
                        'userFile'                      => $userFile
                    ]);
            } catch (TransactionNotApprovedException $ex) {
                return Redirect::route('home')->withError('Failed to Buy Storage');
            }

            return Redirect::route('home')->withStatus('Successfully Bought');
        }
    }
