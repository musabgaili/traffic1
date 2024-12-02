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
        Schema::create('system_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traffic_light_id')->constrained('traffic_lights');
            $table->enum('color', ['red', 'yellow', 'green']);

            // set color to red, yellow or green time limit based on decision  made by AI model
            // seconds
            $table->integer('time_limit');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_colors');
    }
};
