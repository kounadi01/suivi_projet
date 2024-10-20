<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path()."/database/seeders/data.sql";
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
