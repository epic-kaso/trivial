<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 9:13 PM
     */

    namespace TestOauthApp\Services\File;


    class Size
    {

        protected $bytes;

        private function __construct($bytes)
        {
            if (!is_numeric($bytes))
                throw new \InvalidArgumentException('Invalid Number');

            $this->bytes = $bytes;
        }

        public static function Gigabyte($value)
        {
            if (!is_numeric($value))
                throw new \InvalidArgumentException('Invalid Number');

            $bytes = $value * 1024 * 1024 * 1024;

            return new static($bytes);
        }

        public static function Megabyte($value)
        {
            $bytes = $value * 1024 * 1024;

            return new static($bytes);
        }

        public static function Kilobyte($value)
        {
            $bytes = $value * 1024;

            return new static($bytes);
        }

        public static function Bytes($value)
        {
            return new static($value);
        }

        public function humanFileSize($unit = "")
        {
            $size = $this->getBytes();
            if ((!$unit && $size >= 1 << 30) || $unit == "GB")
                return number_format($size / (1 << 30), 2) . "GB";
            if ((!$unit && $size >= 1 << 20) || $unit == "MB")
                return number_format($size / (1 << 20), 2) . "MB";
            if ((!$unit && $size >= 1 << 10) || $unit == "KB")
                return number_format($size / (1 << 10), 2) . "KB";

            return number_format($size) . " bytes";
        }

        /**
         * @return mixed
         */
        public function getBytes()
        {
            return $this->bytes;
        }
    }