<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseTransvargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom',100);
        });
        Schema::create('typeidentite',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('typecontact',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('ville',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->integer('pays_id')->unsigned();
            $table->foreign('pays_id')->references('id')->on('pays');
        });
        Schema::create('identiteaccess',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('email',100)->unique();
            $table->string('statut',5);
            $table->integer('ville_id')->unsigned();
            $table->foreign('ville_id')->references('id')->on('ville');
        });
        Schema::create('contact',function (Blueprint $table){
            $table->increments('id');
            $table->string('valeur',50);
            $table->integer('identiteaccess_id')->unsigned();
            $table->integer('typecontact_id')->unsigned();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
            $table->foreign('typecontact_id')->references('id')->on('typecontact');
        });
        Schema::create('credential',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('password');
            $table->dateTime('dateheurecreation');
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
        });
        Schema::create('typetransporteur',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('client',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('nom',100);
            $table->string('prenoms',150);
            $table->string('raisonsociale',150)->nullable();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
        });
        Schema::create('transporteur',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('nom',100);
            $table->string('prenoms',150);
            $table->string('raisonsociale',150)->nullable();
            $table->string('comptecontribuable',100)->nullable();
            $table->integer('limite')->default(0);
            $table->string('note')->nullable();
            $table->integer('typetransporteur_id')->unsigned();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
            $table->foreign('typetransporteur_id')->references('id')->on('typetransporteur');
        });
        Schema::create('administrateur',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('nom',100);
            $table->string('prenoms',150);
            $table->string('raisonsociale',150)->nullable();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
        });
        Schema::create('typecamion',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',70);
        });
        Schema::create('vehicule',function (Blueprint $table){
            $table->increments('id');
            $table->string('immatriculation',15);
            $table->float('capacite',6,2);
            $table->string('chauffeur',150);
            $table->string('telephone',70);
            $table->integer('transporteur_id')->unsigned();
            $table->integer('typecamion_id')->unsigned();
            $table->foreign('transporteur_id')->references('id')->on('transporteur');
            $table->foreign('typecamion_id')->references('id')->on('typecamion');
        });
        Schema::create('nature',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('destinataire',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom',100);
            $table->string('contact',70);
        });
        Schema::create('expedition',function (Blueprint $table){
            $table->increments('id');
            $table->string('reference',100);
            $table->dateTime('datecreation');
            $table->string('adresselivraison');
            $table->float('masse',6,2);
            $table->string('statut',5);
            $table->bigInteger('prix');
            $table->integer('nature_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->foreign('nature_id')->references('id')->on('nature');
            $table->foreign('client_id')->references('id')->on('client');
        });
        Schema::create('chargement',function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('dateheurechargement');
            $table->string('adressechargement');
            $table->string('nomsociete',100);
            $table->string('nomcontact',100);
            $table->string('contact',70);
            $table->integer('transporteur_id')->unsigned();
            $table->integer('expedition_id')->unsigned();
            $table->integer('ville_id')->unsigned();
            $table->foreign('transporteur_id')->references('id')->on('transporteur');
            $table->foreign('expedition_id')->references('id')->on('expedition');
            $table->foreign('ville_id')->references('id')->on('ville');
        });
        Schema::create('livraison',function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('dateheurelivraison');
            $table->string('commentaire')->nullable();
            $table->integer('expedition_id')->unsigned();
            $table->foreign('expedition_id')->references('id')->on('expedition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraison');
        Schema::dropIfExists('chargement');
        Schema::dropIfExists('expedition');
        Schema::dropIfExists('destinataire');
        Schema::dropIfExists('nature');
        Schema::dropIfExists('vehicule');
        Schema::dropIfExists('typecamion');
        Schema::dropIfExists('administrateur');
        Schema::dropIfExists('transporteur');
        Schema::dropIfExists('client');
        Schema::dropIfExists('typetransporteur');
        Schema::dropIfExists('credential');
        Schema::dropIfExists('contact');
        Schema::dropIfExists('identiteaccess');
        Schema::dropIfExists('ville');
        Schema::dropIfExists('typeidentite');
        Schema::dropIfExists('typecontact');
        Schema::dropIfExists('pays');
    }
}
