<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ManagementPortalUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(BookLeagueMappingSeeder::class);
        $this->call(UserPointSeeder::class);
        $this->call(TransferHistorySeeder::class);
        $this->call(PrefectureSeeder::class);
        $this->call(VideoSeeder::class);
    }
}
