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
            $table->string('hotel_name')->after('status');
            $table->string('hotel_address')->after('hotel_name');
            $table->string('Flight_number')->after('hotel_address');
            $table->timestamp('Flight_time')->after('Flight_number');
            $table->integer('hotel_phone')->nullable()->after('Flight_time');
            $table->string('Comment')->nullable()->after('hotel_phone');
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
