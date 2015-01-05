<?php
    use TestOauthApp\Services\File\Size;

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 9:04 PM
     */
    class Storage extends BaseModel
    {
        protected $table = "storage";

        public function setTotalStorage(Size $size)
        {
            $this->total_storage = $size->getBytes();
        }

        public function getFormattedUsedStorage()
        {
            $size = Size::Bytes($this->used_storage);

            return $size->humanFileSize();
        }

        public function getFormattedTotalStorage()
        {
            $size = Size::Bytes($this->total_storage);

            return $size->humanFileSize();
        }

        public function increaseUsedSize(Size $size)
        {
            $this->used_storage += $size->getBytes();
            $this->save();
        }

        public function deductUsedSize(Size $size)
        {
            if ($this->used_storage > 0)
                $this->used_storage -= $size->getBytes();
            $this->save();
        }

        public function isDiskFull()
        {
            return $this->used_storage >= $this->total_storage;
        }

        public function getPercentageUsed()
        {
            return number_format(100 * ($this->used_storage / $this->total_storage), 2);
        }

        public function getPercentageFreeSpace()
        {
            return number_format(100 * (($this->total_storage - $this->used_storage) / $this->total_storage), 2);
        }

        public function getFormattedFreeStorage()
        {
            $size = Size::Bytes($this->total_storage - $this->used_storage);

            return $size->humanFileSize();
        }

        public function increaseStorageSize(Size $size)
        {
            $this->total_storage += $size->getBytes();

            return $this->save();
        }
    }