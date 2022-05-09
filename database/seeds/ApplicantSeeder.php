<?php

use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 37; $i++) { 
            DB::table('applicants')->insert([
                'user_id' => $i + 143,
                'league_id' => 345,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
