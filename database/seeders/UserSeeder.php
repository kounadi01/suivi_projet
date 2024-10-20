<?php

namespace Database\Seeders;

use App\Models\Structure;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(1)->create();

        DB::table('users')->insert([

            [
                'name' => 'SERI',
                'prenom' => 'Fousseni',
                'email' => 'fouss0101seri@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('responsable'), // password
                'remember_token' => Str::random(10),
                'login' => "responsable",
                'telephone' => "78944824",
                'isenable' => 1,
                'profil_id' => 2,
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'structure_id'=>1
            ],

        ]);
    }
}
