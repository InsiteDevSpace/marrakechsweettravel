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
        Schema::table('reservation_transfers', function (Blueprint $table) {
            $table->string('hotel_name')->nullable()->after('status');
            $table->string('hotel_address')->nullable()->after('hotel_name');
            $table->string('flight_number')->nullable()->after('hotel_address');
            $table->time('flight_time')->nullable()->after('flight_number');
            $table->integer('hotel_phone')->nullable()->after('flight_time');
            $table->string('comment')->nullable()->after('hotel_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_transfers', function (Blueprint $table) {
            //
        });
    }
};
