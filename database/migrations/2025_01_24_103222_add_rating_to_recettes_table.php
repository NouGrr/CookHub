<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('recettes', function (Blueprint $table) {
            $table->float('note_moyenne')->default(0); // Note moyenne
            $table->unsignedInteger('nombre_notes')->default(0); // Nombre de notes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recettes', function (Blueprint $table) {
            //
        });
    }
};
