<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->integer('user_id');
            $table->tinyInteger('push_notif_like')->comment('0: OFF, 1: ON')->default(1);
            $table->tinyInteger('push_notif_message')->comment('0: OFF, 1: ON')->default(1);
            $table->tinyInteger('push_notif_others')->comment('0: OFF, 1: ON')->default(1);
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
        Schema::dropIfExists('notification_settings');
    }
}
