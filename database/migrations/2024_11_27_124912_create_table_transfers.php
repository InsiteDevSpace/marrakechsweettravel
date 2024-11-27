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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->integer('min_people');
            $table->integer('max_people');
            $table->integer('estimated_time')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('departure');
            $table->string('destination');
            $table->enum('type', ['one_way', 'round_trip']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
