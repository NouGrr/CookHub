<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_atelier_user_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtelierUserTable extends Migration
{
    public function up()
    {
        Schema::create('atelier_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atelier_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atelier_user');
    }
}

