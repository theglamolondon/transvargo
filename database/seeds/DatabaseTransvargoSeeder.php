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
        DB::table('staff')->insert([
            [
                "nom" => "Toubo",
                "prenoms" => "Yanick",
                "role" => "ceo",
                "identiteaccess_id" => 1
            ],
        ]);
    }
}