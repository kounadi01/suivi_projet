<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListeProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('annee_id')->unsigned();
            $table->bigInteger('produit_id')->unsigned();
            $table->string('produit')->nullable();
            $table->bigInteger('phase_id')->unsigned()->nullable();
            $table->integer('exploration')->nullable();
            $table->integer('developpement')->nullable();
            $table->integer('exploitation')->nullable();
            $table->integer('rehabilitation')->nullable();
            $table->double('pourcentage')->nullable();



            $table->timestamps();
            $table->softDeletes();

            $table->foreign('produit_id')->references('id')->on('produits');
            $table->foreign('phase_id')->references('id')->on('phases');
            $table->foreign('annee_id')->references('id')->on('annee_exercices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liste_produits');
    }
}
