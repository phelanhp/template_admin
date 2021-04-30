<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
        });

        DB::table('settings')->insert([
            ['key' => 'MAIL_DRIVER', 'value' => 'smtp'],
            ['key' => 'MAIL_HOST', 'value' => 'smtp.gmail.com'],
            ['key' => 'MAIL_PORT', 'value' => 587],
            ['key' => 'MAIL_USERNAME', 'value' => NULL],
            ['key' => 'MAIL_PASSWORD', 'value' => NULL],
            ['key' => 'MAIL_ENCRYPTION', 'value' => 'tls'],
            ['key' => 'MAIL_ADDRESS', 'value' => NULL],
            ['key' => 'MAIL_NAME', 'value' => NULL],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
