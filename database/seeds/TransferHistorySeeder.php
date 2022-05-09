<?php

use Illuminate\Database\Seeder;

class TransferHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TransferHistory::class, 50)->create();
    }
}
