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
         Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->decimal('price', 10, 2);
            $table->string('duration');
            $table->integer('max_participants')->nullable();
            $table->integer('min_age')->nullable();
            $table->text('overview');
            $table->text('description');
            $table->string('location');
            $table->string('map_lat')->nullable();
            $table->string('map_lng')->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
