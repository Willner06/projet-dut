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
        Schema::create('suivi_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('pointage')->nullable();
            $table->string('code_journal')->nullable();
            $table->date('date')->nullable();
            $table->string('numero_piece')->nullable();
            $table->string('libelle')->nullable();
            $table->date('date_echeance')->nullable();
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->string('statut')->nullable();
            $table->foreignId('tiers_id')->constrained('tiers')->onDelete('cascade');
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
        Schema::dropIfExists('suivi_tiers');
    }
};
