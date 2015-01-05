<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 1/4/2015
     * Time: 2:40 PM
     */

    use Laracasts\Commander\Events\EventGenerator;

    class UserFile extends BaseModel
    {
        use EventGenerator;
        /*
         * $table->increments('id');
                $table->string('user_id');
                $table->string('hashcode');
                $table->string('key');
                $table->string('name');
                $table->string('type');
                $table->string('size');
                $table->string('file_path');
                $table->timestamps();
         */
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

        public function getSellingPrice()
        {
            return $this->sell_price;
        }

        public function deleteMe()
        {
            $this->forceDelete();
        }
    }