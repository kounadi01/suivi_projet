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
            $table->text('description')->nullable();
            $table->string('quantite_total')->nullable();;
            $table->string('montant_total')->nullable();;
            $table->string('etat_execution')->nullable();;
            $table->string('localisation')->nullable();;
            $table->date('date_demarrage')->nullable();;
            $table->date('date_fin_probable')->nullable();;
            $table->string('categorie')->nullable();;
            $table->string('taux_physique')->nullable();;
            $table->string('taux_financier')->nullable();;
            $table->string('statut')->nullable();;
            $table->string('unite')->nullable();;
            $table->string('difficultes')->nullable();;
            $table->string('action')->nullable();;
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
