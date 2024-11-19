<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');
            $table->string('meeting_id');
            $table->string('host_id');
            $table->string('host_email');
            $table->string('alternative_hosts')->nullable();
            $table->string('topic');
            $table->datetime('start_date_time');
            $table->integer('duration');
            $table->mediumText('start_url');
            $table->string('join_url');
            $table->string('password');
            $table->boolean('recurring')->default(0);
            $table->integer('recurring_type')->nullable();
            $table->integer('recurring_repeat_interval')->nullable();
            $table->integer('recurring_end_times')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_meetings');
    }
};
