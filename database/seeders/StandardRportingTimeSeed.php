<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandardRportingTimeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('standard_reporting_times')->insert([
            'standard_time' => '08:00:AM',
        ]);
    }
}
