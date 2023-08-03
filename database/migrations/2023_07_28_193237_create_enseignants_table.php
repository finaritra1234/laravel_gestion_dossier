<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('im')->unique();;
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->date('date_naiss');
            $table->string('lieu_naiss');
            $table->string('corps');
            $table->string('grad');
            $table->string('indice');
            $table->string('acte');
            $table->unsignedBigInteger('etablissement_id');
            $table->foreign('etablissement_id')
                  ->references('id')
                  ->on('etablissements')
                  ->onDelete('cascade')
                  ->onUpdate('cascade') ;
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignants');
    }
}
