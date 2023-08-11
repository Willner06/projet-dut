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
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('code_inventaire')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_acquisition')->nullable();
            $table->integer('prix_achat')->nullable();
            $table->integer('autres_frais')->nullable();
            $table->integer('cout_acquisitionTtc')->nullable();
            $table->integer('tva')->nullable();
            $table->string('affectation')->nullable();
            $table->string('etat')->nullable();
            $table->string('fournisseur')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('base_ammortisable')->nullable();
            $table->string('mode_ammortissement')->nullable();
            $table->string('duree_ammortissement')->nullable();
            $table->date('date_mise_au_rebut')->nullable();
            $table->date('date_session')->nullable();
            $table->string('valeur_net_comptable')->nullable();
            $table->integer('prix_vente_valeur_reprise')->nullable();
            $table->string('plus_value_globale')->nullable();
            $table->string('dont_court_terme')->nullable();
            $table->string('dont_long_terme')->nullable();
            $table->string('statut')->default('actif');
            $table->foreignId('categorie_id')->constrained('categorie_materiels')->onDelete('cascade');
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
        Schema::dropIfExists('materiels');
    }
};
