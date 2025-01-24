<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRecettesTable extends Migration
{
    public function up()
    {
        Schema::table('recettes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Ajoute une colonne user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Clé étrangère
        });
    }

    public function down()
    {
        Schema::table('recettes', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Supprime la clé étrangère
            $table->dropColumn('user_id');   // Supprime la colonne user_id
        });
    }
}

