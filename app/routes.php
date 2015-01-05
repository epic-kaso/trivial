<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */


    use Illuminate\Database\Eloquent\ModelNotFoundException;

    Route::model('file_id', 'UserFile');
    Route::model('files', 'UserFile');
    Route::model('user_id', 'User');
    Route::bind('sell', function ($sell) {
        try {
            return UserFile::whereHashcode($sell)->whereIsSellable(TRUE)->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            App::abort(404);
        }
    });

    Route::get('/', ['before' => 'auth', 'as' => 'home', 'uses' => 'HomeController@showWelcome']);

    Route::get('/login', [
        'as'   => 'user.show-login',
        'uses' => 'LoginController@getShowLogin'
    ]);

    Route::post('/login', [
        'as'   => 'user.process-login',
        'uses' => 'LoginController@postProcessLogin'
    ]);

    Route::get('/login/facebook', [
        'as'   => 'user.facebook-login',
        'uses' => 'LoginController@loginWithFacebook'
    ]);

    Route::get('/login/google', [
        'as'   => 'user.google-login',
        'uses' => 'LoginController@loginWithGoogle'
    ]);

    Route::get('/register', [
        'as'   => 'user.show-register',
        'uses' => 'RegisterController@getShowRegister'
    ]);

    Route::post('/register', [
        'as'   => 'user.process-register',
        'uses' => 'RegisterController@postProcessRegister'
    ]);

    Route::get('/forgot-password', [
        'as'   => 'user.forgot-password',
        'uses' => function () {
        }
    ]);

    Route::get('/logout', [
        'as'   => 'user.logout',
        'uses' => function () {
            Auth::logout();

            return Redirect::home();
        }
    ]);


    //User Files
    Route::get('/files/download/{file_id}',
        [
            'before' => 'auth',
            'as'     => 'user.files.download',
            'uses'   => 'FileController@download'
        ]
    );

    Route::post('/files/enable-share-sell/{file_id}',
        [
            'before' => 'auth',
            'as'     => 'user.files.enable-share-sell',
            'uses'   => 'FileController@makeSellable'
        ]
    );

    Route::any('/sell-success',
        [
            'as'     => 'user.sell-success',
            'before' => 'csrf',
            'uses'   => 'SellFileController@sellSuccess'
        ]);
    Route::any('/sell-failure',
        [
            'as'     => 'user.sell-failure',
            'before' => 'csrf',
            'uses'   => 'SellFileController@sellFailure'
        ]);

    Route::resource('/files', 'FileController');
    Route::resource('/sell', 'SellFileController');

    Route::post('oauth/access_token', [
        'as'   => 'oauth-login',
        'uses' => 'OAuthController@postAccessToken'
    ]);


    Route::get('/storage', ['as' => 'user.storage', 'before' => 'auth', 'uses' => 'UserStorageController@index']);
    Route::get('/wallet', ['as' => 'user.wallet', 'before' => 'auth', 'uses' => 'WalletController@index']);