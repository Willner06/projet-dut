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
        Schema::create('decaissements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('somme')->nullable();
            $table->string('num_piece')->nullable();
            $table->string('demandeur')->nullable();
            $table->string('caissier')->nullable();
            $table->string('code')->nullable();
            $table->string('autorisePar')->nullable();
            $table->string('etat')->default('non controlle');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('compte_id')->constrained('comptes')->onDelete('cascade');
            // $table->foreignId('employe_id')->constrained('employes')->onDelete('cascade');
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
        Schema::dropIfExists('decaissements');
    }
};
