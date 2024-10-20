<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('structure_id')->unsigned();
            $table->bigInteger('annee_id')->unsigned();
            $table->bigInteger('produit_id')->unsigned();
            $table->string('etat')->default('En cours'); //En cours, valider ou rejeter
            $table->string('fichier')->nullable();
            $table->string('motifs')->nullable(); //au cous ou l'etat est rejeter
            $table->string('type')->nullable();
            $table->bigInteger('montant_total')->nullable();
            $table->bigInteger('montant_local')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('annee_id')->references('id')->on('annee_exercices');
            $table->foreign('structure_id')->references('id')->on('structures');
            $table->foreign('produit_id')->references('id')->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
