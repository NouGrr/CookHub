<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('recettes', function (Blueprint $table) {
        if (!Schema::hasColumn('recettes', 'titre')) {
            $table->string('titre');
        }
        if (!Schema::hasColumn('recettes', 'description')) {
            $table->text('description');
        }
        if (!Schema::hasColumn('recettes', 'ingredients')) {
            $table->json('ingredients');
        }
        if (!Schema::hasColumn('recettes', 'etapes')) {
            $table->text('etapes');
        }
        if (!Schema::hasColumn('recettes', 'note_moyenne')) {
            $table->float('note_moyenne')->default(0);
        }
        if (!Schema::hasColumn('recettes', 'image')) {
            $table->string('image')->nullable();
        }
    });
}


public function down()
{
    Schema::table('recettes', function (Blueprint $table) {
        $table->dropColumn(['titre', 'description', 'ingredients', 'etapes', 'note_moyenne', 'image']);
    });
}

};
