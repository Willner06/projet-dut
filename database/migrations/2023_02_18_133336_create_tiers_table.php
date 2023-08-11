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
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('nif')->nullable();
            $table->string('localisation')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mail')->nullable();
            $table->string('statut')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiers');
    }
};
