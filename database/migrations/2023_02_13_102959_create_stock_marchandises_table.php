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
        Schema::create('stock_marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('sorti')->nullable();
            $table->string('entre')->nullable();
            $table->string('stock')->nullable();
            $table->string('stock_theorique')->nullable();
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
        Schema::dropIfExists('stock_marchandises');
    }
};
