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


    $monolog = Log::getMonolog();
    $syslog = new \Monolog\Handler\SyslogHandler('papertrail');
    $formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
    $syslog->setFormatter($formatter);

    $monolog->pushHandler($syslog);


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
    Route::bind('user_file', function ($user_file) {
        return UserFile::whereHashcode($user_file)->first();
    });
    Route::bind('data', function ($data) {
        $parsed = base64_decode($data);
        $obj = json_decode($parsed);
        $hashcode = $obj->hashcode;

        return SellableStorageSpace::whereHashcode($hashcode)->first();
    });


    Route::get('/', [
        'before' => 'auth',
        'as'     => 'home',
        'uses'   => 'HomeController@showWelcome'
    ]);

    Route::get('/files-for-sale', [
        'before' => 'auth',
        'as'     => 'home-files-for-sale',
        'uses'   => 'HomeController@showFilesForSale'
    ]);

    Route::get('/purchases', [
        'before' => 'auth',
        'as'     => 'home-purchased-files',
        'uses'   => 'HomeController@showPurchasedFiles'
    ]);

    Route::get('/privacy', [
        'uses' => 'HomeController@showPrivacy'
    ]);

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
    Route::get('/files/download/{user_file}',
        [
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

    Route::post('/files/rename/{user_file}', [
        'before' => 'auth',
        'as'     => 'user.file-rename',
        'uses'   => 'FileController@renameFile'
    ]);

    Route::any('/sell-success/{user_file}',
        [
            'as'     => 'user.sell-success',
            'before' => 'csrf',
            'uses'   => 'SellFileController@sellSuccess'
        ]);
    Route::any('/sell-failure/{user_file}',
        [
            'as'     => 'user.sell-failure',
            'before' => 'csrf',
            'uses'   => 'SellFileController@sellFailure'
        ]);
    Route::post('/files/{user_file}/tag',
        [
            'as' => 'post.user_file_tag',
            'before' => 'auth',
            'uses' => function(UserFile $userFile ){
                $tags = Input::get('tags');
                UserFileTag::createTagsFromString($tags,$userFile->id,Auth::id());
                return Response::json(['tags' => $tags]);
            }
        ]
    );
    Route::resource('/files', 'FileController');
    Route::resource('/sell', 'SellFileController');

    Route::post('oauth/access_token', [
        'as'   => 'oauth-login',
        'uses' => 'OAuthController@postAccessToken'
    ]);


    Route::get('/storage', ['as' => 'user.storage', 'before' => 'auth', 'uses' => 'UserStorageController@index']);
    Route::post('/storage/buy/success/{data}',
        [
            'as'     => 'user.buy-storage-success',
            'before' => 'csrf|auth',
            'uses'   => 'UserStorageController@buySuccess'
        ]
    );
    Route::post('/storage/buy/failure/{data}',
        [
            'as'     => 'user.buy-storage-failure',
            'before' => 'csrf|auth',
            'uses'   => 'UserStorageController@buyFailure'
        ]
    );


    Route::get('/wallet', ['as' => 'user.wallet', 'before' => 'auth', 'uses' => 'WalletController@index']);

    Route::get('/captcha-image',
        [
            'as'   => 'captcha',
            'uses' => function () {
                $expression = Session::get('captcha-expression');

                $img = Image::canvas(220, 70)->text($expression, 65, 60, function ($font) {
                    $font->file(public_path('fonts/Roboto-Regular.ttf'));
                    $font->size(30);
                });

                return $img->response('png');
            }]);

    Route::group(['domain' => 'developers.kaso.co'],function(){
       Route::controller('/','DevelopersPageController');
    });