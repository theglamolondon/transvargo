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
            [ "libelle" => "Administrateur" ],
        ]);

        DB::table('typecamion')->insert([
            [ 'libelle' => 'Camion porteur' ],
            [ 'libelle' => 'Camion semi-remorque' ],
            [ 'libelle' => 'Camion plateau' ],
        ]);

        DB::table('typecamion')->insert([
            [ 'libelle' => 'Camion porteur' ],
            [ 'libelle' => 'Camion semi-remorque' ],
            [ 'libelle' => 'Camion plateau' ],
        ]);

        DB::table('typecontact')->insert([
            [ "libelle" => "Téléphone" ],
            [ "libelle" => "Fax" ],
            [ "libelle" => "Email" ],
            [ "libelle" => "Site web" ],
        ]);

        DB::table('typetransporteur')->insert([
            [ "libelle"  => "Chauffeur patron" ],
            [ "libelle"  => "Propriétaire de flotte" ],
        ]);
        DB::table('pays')->insert([
            [ "nom" => "Côte d'Ivoire" , "indicatif" => "+225" , "monnaie" => "F CFA", "abbreviation" => "CIV"],
            [ "nom" => "Ghana" , "indicatif" => "+233" , "monnaie" => "GHS", "abbreviation" => "GHA"],
            [ "nom" => "Burkina Faso" , "indicatif" => "+226" , "monnaie" => "F CFA", "abbreviation" => "BFA"],
            [ "nom" => "Mali" , "indicatif" => "+226" , "monnaie" => "F CFA", "abbreviation" => "BFA"],
        ]);
        DB::table('ville')->insert([
            [ "nom" => "Abidjan", "pays_id" => 1 ],
            [ "nom" => "San Pédro", "pays_id" => 1 ],
            [ "nom" => "Bouaké", "pays_id" => 1 ],
            [ "nom" => "Yamoussoukro", "pays_id" => 1 ],
            [ "nom" => "Daloa", "pays_id" => 1 ],
            [ "nom" => "Gagnoa", "pays_id" => 1 ],
            [ "nom" => "Adzopé", "pays_id" => 1 ],
            [ "nom" => "Agboville", "pays_id" => 1 ],
            [ "nom" => "Korogho", "pays_id" => 1 ],
            [ "nom" => "Odienné", "pays_id" => 1 ],
            [ "nom" => "Touba", "pays_id" => 1 ],
            [ "nom" => "Duékoué", "pays_id" => 1 ],
            [ "nom" => "Man", "pays_id" => 1 ],
            [ "nom" => "Grand-Lahou", "pays_id" => 1 ],
            [ "nom" => "Dabou", "pays_id" => 1 ],
        ]);
    }
}