<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddOauthTokenDetailsToUsers extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->bigInteger('facebook_end_of_life')->nullable();
                $table->string('facebook_refresh_token')->nullable();
                $table->bigInteger('google_end_of_life')->nullable();
                $table->string('google_refresh_token')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'facebook_end_of_life',
                    'facebook_refresh_token',
                    'google_end_of_life',
                    'google_refresh_token'
                ]);
            });
        }

    }
