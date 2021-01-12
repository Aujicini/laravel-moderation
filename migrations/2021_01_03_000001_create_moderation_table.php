<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModerationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void Returns nothing.
     */
    public function up()
    {
        Schema::create('moderation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('updated_by');
            $table->text('model')->default('user');
            $table->foreignId('user_id');
            $table->enum('status', ['approved', 'rejected', 'postponed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void Returns nothing.
     */
    public function down()
    {
        Schema::dropIfExists('moderation');
    }
}
