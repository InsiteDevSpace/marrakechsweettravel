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
        Schema::table('service_availability', function (Blueprint $table) {
            $table->time('start_time')->nullable()->after('remaining_slots');
            $table->time('end_time')->nullable()->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_availability', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
};
