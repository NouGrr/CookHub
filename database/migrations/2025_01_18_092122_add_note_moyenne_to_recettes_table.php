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
        $table->decimal('note_moyenne', 3, 2)->default(0); // Exemple de note moyenne
    });
}

public function down()
{
    Schema::table('recettes', function (Blueprint $table) {
        $table->dropColumn('note_moyenne');
    });
}

};
