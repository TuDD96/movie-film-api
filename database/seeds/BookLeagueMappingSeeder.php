<?php

use Illuminate\Database\Seeder;

class BookLeagueMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\BookLeagueMapping::class, 100)->create();
        for ($i=0; $i < 37; $i++) { 
            DB::table('book_league_mappings')->insert([
                'book_id' => $i + 234,
                'league_id' => 345,
                'total_score' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
