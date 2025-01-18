<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecettesTable extends Migration
{
    /**
     * Exécuter la migration.
     *
     * @return void
     */
    public function up()
{
    Schema::create('recettes', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->json('ingredients'); // Stocke les ingrédients sous forme de tableau JSON
        $table->text('etapes');
        $table->decimal('note_moyenne', 3, 2)->default(0);
        $table->string('image')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relie l'utilisateur
        $table->timestamps();
    });
}

    

    /**
     * Annuler la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recettes');
    }
}
