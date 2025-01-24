<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_ateliers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAteliersTable extends Migration
{
    public function up()
    {
        Schema::create('ateliers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->dateTime('date');
            $table->integer('duree'); // durée en minutes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ateliers');
    }
}

