<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use TestOauthApp\Services\File\Size;

    class CreateStorageTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('storage', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('hashcode')->nullable();
                $table->bigInteger('total_storage')->default(Size::Gigabyte(1)->getBytes());
                $table->bigInteger('used_storage')->default(0);
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
            Schema::drop('storage');
        }

    }
