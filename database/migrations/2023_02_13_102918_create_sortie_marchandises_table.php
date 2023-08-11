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
        Schema::create('sortie_marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('beneficiaire')->nullable();
            $table->string('quantite')->nullable();
            $table->string('motif')->nullable();
            $table->date('date_sortie')->nullable();
            $table->foreignId('marchandise_id')->constrained('marchandises')->onDelete('cascade');
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
        Schema::dropIfExists('sortie_marchandises');
    }
};
