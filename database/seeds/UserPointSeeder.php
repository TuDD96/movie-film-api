<?php

use Illuminate\Database\Seeder;

class UserPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UserPoint::class, 50)->create();
    }
}
