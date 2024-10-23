<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->text('description');
            $table->string('quantite_total');
            $table->string('montant_total');
            $table->string('etat_execution');
            $table->string('localisation');
            $table->date('date_demarrage');
            $table->date('date_fin_probable');
            $table->string('categorie');
            $table->string('taux_physique');
            $table->string('taux_financier');
            $table->string('statut');
            $table->string('unite');
            $table->foreignId('idSoc')->constrained('societes');
            $table->foreignId('idAnn')->constrained('annee_exercices');
            $table->foreignId('idNat')->constrained('phases');
            $table->foreignId('idBai')->constrained('bailleurs');
            $table->foreignId('idEntr')->constrained('fournisseurs');
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
        Schema::dropIfExists('projets');
    }
}
