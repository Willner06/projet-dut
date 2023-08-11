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
        Schema::create('entre_materiels', function (Blueprint $table) {
            $table->id();
            $table->string('quantite')->nullable();
            $table->string('cout_achat')->nullable();
            $table->date('date_achat')->nullable();
            $table->foreignId('materiel_id')->constrained('materiel_intermediaires')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entre_materiels');
    }
};
