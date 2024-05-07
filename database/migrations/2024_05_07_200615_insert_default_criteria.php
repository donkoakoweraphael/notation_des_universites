<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('criteria')->insert([
            [
                'designation' => 'La qualité de l\'enseignement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation' => 'Les infrastructures',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation' => 'La recherche',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'designation' => 'L\'insertion professionnelle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('criteria')->delete();
    }
};
