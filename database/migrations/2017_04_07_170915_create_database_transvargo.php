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
        Schema::create('typeidentite',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',50);
        });
        Schema::create('identiteaccess',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('statut',5);
            $table->string('activate_token',255);
            $table->string('terms',5);
            $table->integer('typeidentite_id')->unsigned();
            $table->foreign('typeidentite_id')->references('id')->on('typeidentite');
        });
        Schema::create('typetransporteur',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('client',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->dateTime('datecreation');
            $table->string('nom',100);
            $table->string('prenoms',150);
            $table->string('contact',20)->unique();
            $table->string('raisonsociale',150)->nullable();
            $table->boolean('grandcompte')->default(false);
            $table->unsignedInteger('valid_by')->nullable();
            $table->dateTime('dategrandcompte')->nullable();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
            $table->foreign('valid_by')->references('id')->on('identiteaccess');
        });
        Schema::create('transporteur',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('nom',100)->nullable();
            $table->string('prenoms',150)->nullable();
            $table->string('photo',150)->default('default_profile.png');
            $table->string('raisonsociale',150);
            $table->string('contact');
            $table->string('comptecontribuable',100)->nullable();
            $table->integer('limite')->default(0); //Pour la limite des véhicules à ajouter. 0 = illimité
            $table->string('ville');
            $table->unsignedInteger('typetransporteur_id');
            $table->string('nationalite');
            $table->date('datenaissance');
            $table->string('lieunaissance');
            $table->string('rib');
            $table->dateTime('datecreation');
            $table->unsignedInteger('valid_by')->nullable();

            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
            $table->foreign('typetransporteur_id')->references('id')->on('typetransporteur');
            $table->foreign('valid_by')->references('id')->on('identiteaccess');
        });
        Schema::create('chauffeurpatron',function (Blueprint $table){
            $table->string('nomprenomsU1');
            $table->string('professionU1');
            $table->string('contactU1');
            $table->string('localisationU1');
            $table->string('observationU1')->nullable();

            $table->string('nomprenomsU2');
            $table->string('professionU2');
            $table->string('contactU2');
            $table->string('localisationU2');
            $table->string('observationU2')->nullable();

            $table->unsignedInteger('transport_id');
            $table->primary('transport_id');
            $table->foreign('transport_id')->references('identiteaccess_id')->on('transporteur');
        });
        Schema::create('staff',function (Blueprint $table){
            $table->integer('identiteaccess_id')->unsigned();
            $table->string('nom',100);
            $table->string('prenoms',150);
            $table->string('role',255)->default('000');
            $table->string('raisonsociale',150)->nullable();
            $table->foreign('identiteaccess_id')->references('id')->on('identiteaccess');
        });
        Schema::create('typecamion',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle',70);
            $table->string('description')->nullable();
        });
        Schema::create('tonnage', function (Blueprint $table){
            $table->increments('id');
            $table->integer('masse');
            $table->unsignedInteger('typecamion_id');
            $table->foreign('typecamion_id')->references('id')->on('typecamion');
        });
        Schema::create('vehicule',function (Blueprint $table){
            $table->increments('id');
            $table->string('firebasetoken',255)->nullable();
            $table->string('immatriculation',15);
            $table->float('capacite',8,2);
            $table->string('chauffeur',150);
            $table->string('telephone',70);
            $table->string('statut')->defalut(\App\Services\Statut::TYPE_VEHICULE.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL);
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
        /*
        Schema::create('facture',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->dateTime('datefacture');
            $table->string("reference");
            $table->string("statut");
            $table->bigInteger('montant');
            $table->float('tva',2,2)->default('0.18');
            $table->dateTime('datecreation');
            $table->dateTime('datemodification');
            $table->unsignedInteger("staff_id");
            $table->unsignedInteger("client_id");
            $table->foreign("staff_id")->references("identiteaccess_id")->on("staff");
            $table->foreign("staff_id")->references("identiteaccess_id")->on("client");
        });
        */
        Schema::create('assurance',function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create('expedition',function (Blueprint $table){
            $table->increments('id');
            $table->string('reference',100);
            $table->dateTime('dateheurecreation');
            $table->dateTime('dateheureacceptation')->nullable();
            $table->date('datechargement');
            $table->date('dateexpiration');
            $table->string('lieudepart',100);
            $table->string('coorddepart',100);
            $table->string('lieuarrivee',100);
            $table->string('coordarrivee',100);
            $table->float('masse',10,2);
            $table->string('statut',5);
            $table->boolean('fragile')->default(false);
            $table->integer('prix')->default(0);
            $table->integer('distance')->nullable();
            //$table->string('remarque')->nullable();
            //$table->integer('nature_id')->unsigned();
            $table->boolean('isassure')->default(false);
            $table->integer('mttassurance')->default(0);
            $table->integer("fraisannexe")->default(0);
            $table->unsignedInteger('assurance_id');
            $table->integer('client_id')->unsigned();
            $table->integer('typecamion_id')->unsigned();
            $table->integer('tonnage_id')->unsigned()->nullable();
            $table->string("facture", 100)->nullable();
            $table->string("bonlivraison", 100)->nullable();
            $table->foreign('typecamion_id')->references('id')->on('typecamion');
            //$table->foreign('nature_id')->references('id')->on('nature');
            $table->foreign('client_id')->references('identiteaccess_id')->on('client');
            $table->foreign('assurance_id')->references('id')->on('assurance');
            $table->foreign('tonnage_id')->references('id')->on('tonnage');
            //$table->foreign('facture_id')->references('id')->on('facture');
        });
        Schema::create('chargement',function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('dateheurechargement')->nullable();
            $table->string('adressechargement')->nullable();
            $table->string('societechargement',100)->nullable();
            $table->string('contactchargement',100);
            $table->string('telephonechargement',15);
            $table->string('adresselivraison')->nullable();
            $table->string('societelivraison',100)->nullable();
            $table->string('contactlivraison',100);
            $table->string('telephonelivraison',15);
            $table->string('otp',5)->nullable();
            $table->dateTime('dateheureotp')->nullable();
            $table->dateTime('dateheurelivraison')->nullable();
            $table->integer('vehicule_id')->unsigned()->nullable();
            $table->integer('expedition_id')->unsigned();
            $table->foreign('vehicule_id')->references('id')->on('vehicule');
            $table->foreign('expedition_id')->references('id')->on('expedition');
        });
        Schema::create('localisation',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->dateTime('datelocalisation');
            $table->string('latitude',50);
            $table->string('longitude',50);
            $table->string('speed',15)->default("0");
            $table->integer('vehicule_id')->unsigned();
            $table->foreign('vehicule_id')->references('id')->on('vehicule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localisation');
        Schema::dropIfExists('livraison');
        Schema::dropIfExists('chargement');
        Schema::dropIfExists('expedition');
        //Schema::dropIfExists('facture');
        Schema::dropIfExists('assurance');
        Schema::dropIfExists('destinataire');
        Schema::dropIfExists('nature');
        Schema::dropIfExists('vehicule');
        Schema::dropIfExists('tonnage');
        Schema::dropIfExists('typecamion');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('chauffeurpatron');
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
