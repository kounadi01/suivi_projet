<?php

namespace Database\Seeders;

use App\Models\Profil;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // check if table users is empty


            DB::table('profils')->insert([

                [
                    'nom' => 'Administrateur',
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ],
                [
                    'nom' => 'Consulter',
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ],
                [
                    'nom' => 'Responsable',
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ],
                [
                    'nom' => 'Moderateur',
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ],
                [
                    'nom' => 'Agent',
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ]

            ]);

    }
}
