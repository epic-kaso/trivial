<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddOauthTokenToUsers extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('facebook_enabled')->default(FALSE);
                $table->string('facebook_oauth_token')->nullable();
                $table->boolean('google_enabled')->default(FALSE);
                $table->string('google_oauth_token')->nullable();

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
                $table->dropColumn(
                    [
                        'facebook_enabled',
                        'facebook_oauth_token',
                        'google_enabled',
                        'google_oauth_token'
                    ]);
            });
        }

    }
