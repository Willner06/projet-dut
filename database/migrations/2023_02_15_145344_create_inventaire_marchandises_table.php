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
        Schema::create('inventaire_marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('designation')->nullable();
            $table->string('prix_unitaire')->nullable();
            $table->string('categorie')->nullable();
            $table->string('quantite_entre')->nullable();
            // $table->string('date_entre')->nullable();
            $table->string('quantite_sorti')->nullable();
            $table->string('quantite_stock')->nullable();
            $table->string('agent_superviseur')->nullable();
            $table->string('agent_2')->nullable();
            $table->string('lieu')->nullable();
            $table->string('valeur_stock')->nullable();
            $table->string('commentaire')->nullable();
            // $table->foreignId('marchandise_id')->constrained('marchandises')->onDelete('cascade');
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
        Schema::dropIfExists('inventaire_marchandises');
    }
};
