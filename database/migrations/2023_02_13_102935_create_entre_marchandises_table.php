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
        Schema::create('entre_marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('fournisseur')->nullable();
            $table->string('quantite')->nullable();
            $table->string('motif')->nullable();
            $table->date('date_achat')->nullable();
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
        Schema::dropIfExists('entre_marchandises');
    }
};
