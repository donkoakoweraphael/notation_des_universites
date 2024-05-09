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
        DB::table('settings')
        ->where('key', 'number_of_digits_after_decimal_point')
        ->update(['name' => 'Nombre de chiffre apres la virgule pour les notes']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
