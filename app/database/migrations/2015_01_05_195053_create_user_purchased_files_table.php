<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUserPurchasedFilesTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('user_purchased_files', function (Blueprint $table) {
                $table->increments('id');
                $table->string('hashcode');
                $table->integer('user_file_id');
                $table->integer('user_id');
                $table->integer('download_count');
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
            Schema::drop('user_purchased_files');
        }

    }
