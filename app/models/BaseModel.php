<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/18/14
     * Time: 12:24 PM
     */

    use Carbon\Carbon;

    class BaseModel extends Eloquent
    {

        protected $errors;

        protected $guarded = ['id'];

        public static function boot()
        {
            parent::boot();

            static::saving(function ($model) {
                $model->generateHashCode();
                $model->finalizeDuringSaving();

                return $model->validate();
            });

            static::creating(function ($model) {
                $model->finalizeDuringCreating();

                return TRUE;
            });
        }

        public function getErrors()
        {
            return $this->errors;
        }

        public function today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            return $this->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow);
        }

        public function day($dateString)
        {
            $today = Carbon::parse($dateString);
            $tomorrow = $today->tomorrow();

            return $this->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow);
        }

        public function thisWeek()
        {
            $today = Carbon::today();
            $weekStart = $today->startOfWeek()->toDateTimeString();
            $weekend = $today->endOfWeek()->toDateTimeString();

            return $this->where('created_at', '>=', $weekStart)->where('created_at', '<=', $weekend);
        }

        public function thisMonth()
        {
            $today = Carbon::today();
            $monthStart = $today->startOfMonth()->toDateTimeString();
            $monthEnd = $today->endOfMonth()->toDateTimeString();

            return $this->where('created_at', '>=', $monthStart)->where('created_at', '<=', $monthEnd);
        }

        public function thisYear()
        {
            $today = Carbon::today();
            $yrStart = $today->startOfYear()->toDateTimeString();
            $yrEnd = $today->endOfYear()->toDateTimeString();

            return $this->where('created_at', '>=', $yrStart)->where('created_at', '<=', $yrEnd);
        }

        public function generateHashCode()
        {
            if (!empty($this->hashcode))
                return;

            $code = random_string('numeric');

            if (!$this->where(['hashcode' => $code])->first()) {
                $this->hashcode = $code;

                return;
            } else {
                $this->generateHashCode();
            }
        }

        protected function validate()
        {
            if (isset(static::$validation_rules)) {
                $validation = Validator::make($this->getAttributes(), static::$validation_rules);

                if ($validation->fails()) {
                    $this->errors = $validation->messages();

                    return FALSE;
                }
            }

            return TRUE;
        }

        protected function finalizeDuringSaving()
        {

        }

        protected function finalizeDuringCreating()
        {

        }
    }