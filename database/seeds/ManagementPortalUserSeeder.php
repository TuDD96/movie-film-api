<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\SoftDeletes\CustomSoftDeletes;

class ManagementPortalUserSeeder extends Seeder
{
    use CustomSoftDeletes;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mgmt_portal_users')->insert([
            [
                'mgmt_portal_user_id' => 1,
                'email' => 'systemadmin@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
