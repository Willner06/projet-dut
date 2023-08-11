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
        Schema::create('clotures', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('agent_caisse')->nullable();
            $table->string('controlleur')->nullable();
            $table->dateTime('date_controle')->nullable();
            $table->bigInteger('solde_theorique')->nullable();
            $table->bigInteger('solde_reel')->nullable();
            $table->bigInteger('ecart')->nullable();
            $table->string('commentaire')->nullable();
            $table->boolean('status')->default(false);
            // $table->foreignId('user_id')->restrictOnDelete()->constrained('users');
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
        Schema::dropIfExists('clotures');
    }
};
