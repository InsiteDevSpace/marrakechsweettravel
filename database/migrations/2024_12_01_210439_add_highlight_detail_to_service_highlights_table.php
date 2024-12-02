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
        Schema::table('service_highlights', function (Blueprint $table) {
            $table->text('highlight_detail')->nullable()->after('text'); // Adding highlight_detail column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_highlights', function (Blueprint $table) {
            $table->dropColumn('highlight_detail'); // Dropping highlight_detail column
        });
    }
};
