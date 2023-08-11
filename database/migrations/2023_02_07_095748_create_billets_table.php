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
        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('b10000')->nullable();
            $table->bigInteger('b5000')->nullable();
            $table->bigInteger('b2000')->nullable();
            $table->bigInteger('b1000')->nullable();
            $table->bigInteger('b500')->nullable();

            $table->bigInteger('p500')->nullable();
            $table->bigInteger('p100')->nullable();
            $table->bigInteger('p50')->nullable();
            $table->bigInteger('p25')->nullable();
            $table->bigInteger('p10')->nullable();
            $table->bigInteger('p5')->nullable();
            $table->bigInteger('p1')->nullable();
            $table->bigInteger('soldeInventaire')->nullable();
            // $table->foreignId('suivi_id')->constrained('suivicaisses')->onDelete('cascade');
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
        Schema::dropIfExists('billets');
    }
};
