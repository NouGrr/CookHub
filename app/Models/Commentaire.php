<?php

use App\Models\Recette;

class CreateCommentairesTable extends Migration
{
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');
            $table->unsignedBigInteger('recette_id');
            $table->timestamps();

            // Définir la clé étrangère avec le modèle Recette
            $table->foreign('recette_id')->references('id')->on('recettes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
