<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('type');
            $table->boolean('decret')->default(0);

            $table->timestamps();
            $table->softDeletes();
            // $table->integer('prixachat');
            // $table->string('prixvente');
            // $table->double('tva')->default(18);

            // $table->bigInteger('categorie_id')->unsigned();

            // $table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
