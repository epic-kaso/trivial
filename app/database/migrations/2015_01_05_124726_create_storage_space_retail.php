<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateStorageSpaceRetail extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('sellable_storage_spaces', function (Blueprint $table) {
                $table->increments('id');
                $table->string('hashcode');
                $table->bigInteger('size')->required();
                $table->string('name')->required();
                $table->string('description')->nullable();
                $table->decimal('price')->required();
                $table->bigInteger('bonus')->nullable();
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
            Schema::drop('sellable_storage_spaces');
        }

    }
