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
            $table->unique(['title', 'university_id'], 'info_section_title_univ_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_sections', function (Blueprint $table) {
            $table->dropUnique('info_section_title_univ_id_unique');
        });
    }
};
