<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanRealisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_realisations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('montant_total')->nullable();
            $table->bigInteger('montant_local')->nullable();
            $table->string('fichier')->nullable();

            $table->bigInteger('plan_approvision_id')->unsigned();
            $table->bigInteger('fournisseur_id')->unsigned();
            $table->bigInteger('reponse_id')->unsigned();
            $table->string('fournisseurs')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plan_approvision_id')->references('id')->on('plan_approvisions');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
            $table->foreign('reponse_id')->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_realisations');
    }
}
