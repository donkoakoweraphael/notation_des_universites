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
        DB::table('settings')->insert([
            [
                'key' => 'comments_number_per_user_per_university_per_day',
                'name' => 'Nombre de commentaires que peut faire un utilisateur par jour sur une université',
                'value' => 1,
            ],
            [
                'key' => 'max_note_to_display',
                'name' => 'Afficher les notes des universités sur combien',
                'value' => 5,
            ],
            [
                'key' => 'number_of_digits_after_decimal_point',
                'name' => 'Nombre de commentaires que peut faire un utilisateur par jour sur une université',
                'value' => 1,
            ],
            [
                'key' => 'number_of_university_per_page',
                'name' => 'Nombre d\'universités à afficher par page dans le classement',
                'value' => 10,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')
            ->where('key', 'in', [
                'comments_number_per_user_per_university_per_day',
                'max_note_to_display',
                'number_of_digits_after_decimal_point',
                'number_of_university_per_page',
            ])->delete();
    }
};
