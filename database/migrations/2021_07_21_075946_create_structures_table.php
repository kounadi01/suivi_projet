<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('nom_struct');
            $table->string('sigle_struct')->nullable();
            $table->string('type_struct')->nullable();
            $table->string('phase_struct')->nullable();
            $table->string('tel_struct')->nullable();
            $table->string('siege')->nullable();
            $table->string('categorie')->nullable();
            $table->string('ifu')->nullable()->unique();
            $table->string('email_struct');
            $table->string('responsable_struct');
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
        Schema::dropIfExists('structures');
    }
}
