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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('score');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained(table: 'users')
                ->nullOnDelete();
            $table->foreignId('university_id')
                ->constrained(table: 'universities')
                ->cascadeOnDelete();
            $table->foreignId('criterion_id')
                ->nullable()
                ->constrained(table: 'criteria')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
