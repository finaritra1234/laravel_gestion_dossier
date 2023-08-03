<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraitementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            $table->string('date_depot')->nullable();
            $table->date('date_envoye')->nullable();
            $table->string('date_retour')->nullable();
            $table->string('status')->nullable();
            $table->string('motif')->nullable();
            $table->unsignedBigInteger('enseignant_id');
            $table->unsignedBigInteger('dossier_id');
            $table->unsignedBigInteger('responsable_id');
            $table->foreign('dossier_id')
                  ->references('id')
                  ->on('dossiers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('responsable_id')
                  ->references('id')
                  ->on('responsables')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('enseignant_id')
                  ->references('id')
                  ->on('enseignants')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('traitements');
    }
}
