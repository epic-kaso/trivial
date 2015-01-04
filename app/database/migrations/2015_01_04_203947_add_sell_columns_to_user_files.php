<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddSellColumnsToUserFiles extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('user_files', function (Blueprint $table) {
                $table->boolean('is_sellable')->default(FALSE);
                $table->decimal('sell_price')->default(0.0);
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
                $table->dropColumn([
                    'is_sellable',
                    'sell_price'
                ]);
            });
        }

    }
