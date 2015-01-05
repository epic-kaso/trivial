<?php

    use Illuminate\Auth\Reminders\RemindableInterface;
    use Illuminate\Auth\Reminders\RemindableTrait;
    use Illuminate\Auth\UserInterface;
    use Illuminate\Auth\UserTrait;
    use Laracasts\Commander\Events\EventGenerator;

    class User extends BaseModel implements UserInterface, RemindableInterface
    {

        use UserTrait, RemindableTrait, EventGenerator;

        protected $fillable = array('email', 'password');

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = array('password', 'remember_token');


        public function setPasswordAttribute($password)
        {
            $this->attributes['password'] = Hash::make($password);
        }

        public function hasPassword()
        {
            return isset($this->password);
        }

        public function hasHashcode()
        {
            return isset($this->hashcode);
        }

        public function isFacebookOauthEnabled()
        {
            return $this->facebook_enabled ? TRUE : FALSE;
        }

        public function enableFacebookOauth($facebook_oauth)
        {
            if (empty($facebook_oauth))
                throw new InvalidArgumentException('Oauth Token Can not be empty');

            $this->facebook_enabled = TRUE;
            $this->facebook_oauth_token = $facebook_oauth->getAccessToken();
            $this->facebook_refresh_token = $facebook_oauth->getRefreshToken();
            $this->facebook_end_of_life = $facebook_oauth->getEndOfLife();
            $this->save();
        }

        public function isGoogleOauthEnabled()
        {
            return $this->google_enabled ? TRUE : FALSE;
        }

        public function enableGoogleOauth($google_oauth)
        {
            if (empty($google_oauth))
                throw new InvalidArgumentException('Oauth Token Can not be empty');

            $this->google_enabled = TRUE;
            $this->google_oauth_token = $google_oauth->getAccessToken();
            $this->google_refresh_token = $google_oauth->getRefreshToken();
            $this->google_end_of_life = $google_oauth->getEndOfLife();
            $this->save();
        }

        public function getDirectory()
        {
            return Str::slug($this->email);
        }

        public function storage()
        {
            return $this->hasOne('Storage');
        }

        public function userFiles()
        {
            return $this->hasMany('UserFile');
        }

        public function handleFilePayment(UserFile $file)
        {
            $price = $file->getPrice();
            $realPrice = $this->getRealPrice($price);
            $this->creditWallet($realPrice);
            $this->save();

            return $this;
        }

        private function getRealPrice($price)
        {
            return Config::get('my-config.user-sales-share') * $price;
        }

        public function creditWallet($realPrice)
        {
            if (!is_numeric($realPrice) || $realPrice <= 0)
                return;
            $this->wallet += $realPrice;
        }

        public function addFileToMyPurchases(UserFile $file)
        {
            $purchases = new UserPurchasedFile();
            $purchases->download_count = 1;
            $purchases->userFile()->associate($file);

            return $this->purchasedFiles()->save($purchases);
        }

        public function purchasedFiles()
        {
            return $this->hasMany('UserPurchasedFile');
        }
    }
