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
            [ 'libelle' => 'Camion baché', "description" => "Camion pouvant accpeter une charge de 1 à 3 tonnes" ],
            [ 'libelle' => 'Camion porteur', "description" => "Camion pouvant accepter une charge de 1 à 19 tonnes" ],
            [ 'libelle' => 'Camion remorque', "description" => "Camion pouvant accepter une charge de plus de 20 tonnes" ],
            [ 'libelle' => 'Camion plateau', "description" => "Marchandises en palette" ],
            [ 'libelle' => 'Benne', "description" => "Benne camion pour sable, gravier et autre" ],
        ]);

        DB::table('tonnage')->insert([
            [ 'masse' => 1, "typecamion_id" => 1],
            [ 'masse' => 2, "typecamion_id" => 1],
            [ 'masse' => 3, "typecamion_id" => 1],

            [ 'masse' => 5, "typecamion_id" => 2],
            [ 'masse' => 7, "typecamion_id" => 2],
            [ 'masse' => 10, "typecamion_id" => 2],
            [ 'masse' => 13, "typecamion_id" => 2],
            [ 'masse' => 15, "typecamion_id" => 2],
            [ 'masse' => 17, "typecamion_id" => 2],

            [ 'masse' => 20, "typecamion_id" => 3],
            [ 'masse' => 25, "typecamion_id" => 3],
            [ 'masse' => 30, "typecamion_id" => 3],
            [ 'masse' => 35, "typecamion_id" => 3],
            [ 'masse' => 40, "typecamion_id" => 3],
            [ 'masse' => 45, "typecamion_id" => 3],
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