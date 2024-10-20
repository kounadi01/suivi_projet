<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnneeExercicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annee_exercices', function (Blueprint $table) {
            $table->id();
            $table->integer('annee_exercice')->unique();
            $table->string('statut')->default("inactive");
            $table->date('date_debut_prevision')->nullable();
            $table->date('date_fin_prevision')->nullable();
            $table->date('date_debut_realisation')->nullable();
            $table->date('date_fin_realisation')->nullable();
            // $table->boolean('cloture_exerc')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annee_exercices');
    }
}
