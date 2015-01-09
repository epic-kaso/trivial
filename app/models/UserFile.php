<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 2:40 PM
     */

    use Laracasts\Commander\Events\EventGenerator;
    use TestOauthApp\Services\File\Size;

    class UserFile extends BaseModel
    {
        use EventGenerator;

        protected $table = "user_files";
        protected $guarded = array('id', 'hashcode');

        public function getFileKey()
        {
            return $this->key;
        }

        public function getPath()
        {
            return $this->file_path;
        }

        public function isSellable()
        {
            return $this->is_sellable;
        }

        public function makeSellable($sellingPrice)
        {
            if (is_numeric($sellingPrice)) {
                $this->is_sellable = TRUE;
                $this->sell_price = $sellingPrice;

                return $this->save();
            }
            throw new InvalidArgumentException('Selling price must be a number');
        }

        public function deleteMe()
        {
            $this->forceDelete();
        }

        public function getPrice()
        {
            return $this->sell_price;
        }

        public function user()
        {
            return $this->belongsTo('User');
        }

        public function increaseDownloadCount()
        {
            $this->download_count += 1;
            $this->save();
        }

        public function getDownloadCount()
        {
            return number_format($this->download_count);
        }

        public function getFormattedSize()
        {
            $size = Size::Bytes($this->size);

            return $size->humanFileSize();
        }

        public function rename($newName)
        {
            $this->name = $newName;
            $this->save();
        }

        public function downloadUrl()
        {
            if ((Auth::check() && $this->belongsToUser(Auth::user())) || $this->isFree()) {
                $url = route('user.files.download', [$this->hashcode]);

                return $url;
            } else {
                return $this->purchaseUrl();
            }
        }

        public function belongsToUser(User $user)
        {
            return $this->user->id == $user->id;
        }

        public function isFree()
        {
            return $this->getSellingPrice() <= 0;
        }

        public function getSellingPrice()
        {
            return $this->sell_price;
        }

        private function purchaseUrl()
        {
            return "";
        }

        public function downloadLink($title, array $attributes)
        {
            if ((Auth::check() && $this->belongsToUser(Auth::user())) || $this->isFree()) {
                $url = route('user.files.download', [$this->hashcode]);

                return HTML::link($url, $title, $attributes);
            } else {
                return $this->purchaseLink($title, $attributes);
            }
        }

        private function purchaseLink($title, array $attributes)
        {
            return "";
        }

        public function tags()
        {
            return $this->hasMany('UserFileTag');
        }

        public function isReady()
        {
            return $this->active ? TRUE : FALSE;
        }

        public function setReady($state)
        {
            $this->active = $state;
            $this->save();
        }

    }