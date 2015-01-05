<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddDownloadsCountToUserFile extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('user_files', function (Blueprint $table) {
                $table->bigInteger('download_count');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('user_files', function (Blueprint $table) {
                $table->dropColumn('download_count');
            });
        }

    }
