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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groupID')->constrained('groups');
            $table->string('meetingDate');
            $table->string('meetingTime');
            $table->string('meetingDesc');
            $table->string('meetingLink')->nullable();;
            $table->string('meetingModerator');
            $table->string('meetingNotes')->nullable();
            $table->string('meetingProgress')->default("Incomplete");
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
        Schema::dropIfExists('meetings');
    }
};
