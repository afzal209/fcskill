<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fcm_tokens', function (Blueprint $table) {
            //
            $table->bigInteger('signals_notif')->comment('0=off,1=on')->default(1)->after('user_choice');
            $table->bigInteger('prediction_notif')->comment('0=off,1=on')->default(1)->after('signals_notif');
            $table->bigInteger('updates_notif')->comment('0=off,1=on')->default(1)->after('prediction_notif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fcm_tokens', function (Blueprint $table) {
            //
        });
    }
};
