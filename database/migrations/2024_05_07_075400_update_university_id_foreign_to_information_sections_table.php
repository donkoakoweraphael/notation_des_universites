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
        Schema::table('information_sections', function (Blueprint $table) {
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade')->change();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_sections', function (Blueprint $table) {
            $table->dropForeign('information_sections_university_id_foreign');
        });
    }
};
