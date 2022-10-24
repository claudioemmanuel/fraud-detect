<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 155);
            $table->date('birth_date');
            $table->string('rg', 50);
            $table->string('cpf', 50);
            $table->string('streetName', 155);
            $table->string('buildingNumber', 50);
            $table->string('neighborhood', 155);
            $table->string('city', 155);
            $table->string('state', 2);
            $table->string('postcode', 50);
            $table->string('profile_photo_path', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
