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
    }
}