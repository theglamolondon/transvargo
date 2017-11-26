<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseTransvargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeidentite')->insert([
            [ "libelle" => "Client" ],
            [ "libelle" => "Transporteur" ],
            [ "libelle" => "Staff" ],
        ]);

        DB::table('typecamion')->insert([
            [ 'libelle' => 'Camion porteur' ],
            [ 'libelle' => 'Camion semi-remorque' ],
            [ 'libelle' => 'Camion plateau' ],
            [ 'libelle' => 'Bachet' ],
            [ 'libelle' => 'Utilitaire' ],
        ]);

        DB::table('typetransporteur')->insert([
            [ "libelle"  => "Chauffeur patron" ],
            [ "libelle"  => "Propriétaire de flotte" ],
        ]);

        DB::table('identiteaccess')->insert([
            [
                "email"  => "admin@transvargo.com" ,
                "password"  => bcrypt('azerty'),
                "statut" => \App\Services\Statut::TYPE_IDENTITE_ACCESS.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL,
                "activate_token" => "ND",
                "terms" => 1,
                "typeidentite_id" => 3
            ],
        ]);
        DB::table('identiteaccess')->insert([
            [
                "email"  => "glamolondon@gmail.com" ,
                "password"  => bcrypt('azerty'),
                "statut" => \App\Services\Statut::TYPE_IDENTITE_ACCESS.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL,
                "activate_token" => "ND",
                "terms" => 1,
                "typeidentite_id" => 1
            ],
        ]);
        DB::table('identiteaccess')->insert([
            [
                "email"  => "glamolondon@live.fr" ,
                "password"  => bcrypt('azerty'),
                "statut" => \App\Services\Statut::TYPE_IDENTITE_ACCESS.\App\Services\Statut::ETAT_ACTIF.\App\Services\Statut::AUTRE_NON_NULL,
                "activate_token" => "ND",
                "terms" => 1,
                "typeidentite_id" => 2
            ],
        ]);

        DB::table('staff')->insert([
            [
                "nom" => "Toubo",
                "prenoms" => "Yanick",
                "role" => "CEO",
                "identiteaccess_id" => 1
            ],
        ]);

        DB::table('client')->insert([
           [
               "nom" => "Koffi",
               "prenoms" => "Willy",
               "contact" => "47631443",
               "raisonsociale" => "Koffi",
               "datecreation" => Carbon\Carbon::now()->toDateTimeString(),
               "identiteaccess_id" => 2
           ]
        ]);

        DB::table('transporteur')->insert([
            [
                "nom" => "Koff",
                "prenoms" => "Berenger",
                "raisonsociale" => "BYES",
                "contact" => "22437318",
                "comptecontribuable" => "CI-ABJ-2014-125A",
                "ville" => "ABIDJAN",
                "nationalite" => "Ivoirienne",
                "typetransporteur_id" => 1,
                "datecreation" => Carbon\Carbon::now()->toDateTimeString(),
                "datenaissance" => "1967-05-25",
                "lieunaissance" => "Cocody",
                "rib" => "12548896587",
                "identiteaccess_id" => 3
            ]
        ]);
    }
}