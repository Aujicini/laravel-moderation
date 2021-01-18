<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void Returns nothing.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->ipAddress('ip_address_register')->after('password')->nullable();
            $table->ipAddress('ip_address_last')->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void Returns nothing.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ip_address_register', 'ip_address_last');
        });
    }
}
