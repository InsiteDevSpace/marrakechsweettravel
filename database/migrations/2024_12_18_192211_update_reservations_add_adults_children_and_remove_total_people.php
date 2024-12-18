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
            // Add new columns
            $table->integer('adults_count')->default(1)->after('transfer_id');
            $table->integer('children_count')->default(0)->after('adults_count');
            
            // Remove total_people column
            $table->dropColumn('total_people');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_transfers', function (Blueprint $table) {
            // Add the total_people column back
            $table->integer('total_people')->nullable()->after('transfer_id');

            // Drop the new columns
            $table->dropColumn(['adults_count', 'children_count']);
        });
    }
};
