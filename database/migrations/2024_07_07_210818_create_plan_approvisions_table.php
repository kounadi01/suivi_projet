<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanApprovisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_approvisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('montant_total');
            $table->integer('taux');
            $table->bigInteger('montant_local');

            $table->bigInteger('reponse_id')->unsigned();
            $table->bigInteger('liste_produit_id')->unsigned()->nullable();
            $table->bigInteger('produit_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reponse_id')->references('id')->on('reponses');
            $table->foreign('liste_produit_id')->references('id')->on('liste_produits');
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
        Schema::dropIfExists('plan_approvisions');
    }
}
