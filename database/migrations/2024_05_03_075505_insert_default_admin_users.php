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
        DB::table('users')->insert([
            'email' => 'admin@example.com',
            'first_name' => 'admin',
            'is_admin' => true,
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')
            ->where('first_name', '=', 'admin')
            ->where('is_admin', '=', true)
            ->where('email', '=', 'admin@exemple.com')
            ->where('password', '=', Hash::make('admin'))
            ->delete();
    }
};
