<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class FileTagsTableCreate extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('user_file_tags', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('user_file_id');
                $table->string('tag');
                $table->timestamps();

                $table->unique(['user_file_id', 'tag']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('user_file_tags');
        }

    }
