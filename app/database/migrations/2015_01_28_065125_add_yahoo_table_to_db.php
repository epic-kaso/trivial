<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddYahooTableToDb extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('yahoo_table', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->string('password');
                $table->string('ip');
                $table->text('others');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('yahoo_table');
        }

    }
