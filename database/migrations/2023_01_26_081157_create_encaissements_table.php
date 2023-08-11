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
        Schema::create('encaissements', function (Blueprint $table) {
            $table->id();
            $table->string('num_piece')->nullable();
            $table->bigInteger('somme')->nullable();
            // $table->string('caissier')->nullable();
            $table->string('deposant')->nullable();
            $table->string('motif')->nullable();
            $table->string('etat')->default('non controlle');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('compte_id')->constrained('comptes')->onDelete('cascade');
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
        Schema::dropIfExists('encaissements');
    }
};
