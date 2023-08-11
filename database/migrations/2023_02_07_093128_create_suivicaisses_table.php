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
        Schema::create('suivicaisses', function (Blueprint $table) {
            $table->id();
            $table->string('num_piece');
            $table->string('code');
            $table->string('libelle');
            $table->bigInteger('montant');
            $table->string('date');
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
        Schema::dropIfExists('suivicaisses');
    }
};
