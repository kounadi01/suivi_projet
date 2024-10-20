<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('prevision')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->boolean('envoye')->default(0);
            $table->boolean('ouvert')->default(0);
            $table->date('date_reouverture')->nullable();

            $table->bigInteger('structure_id')->unsigned();
            $table->bigInteger('annee_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('annee_id')->references('id')->on('annee_exercices');
            $table->foreign('structure_id')->references('id')->on('structures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponses');
    }
}
