<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$client = DB::table('users')->where('type', 'client')->first();
        if(!$client) {
            User::factory(10)->create();
		}

		$vendor = DB::table('users')->where('type', 'vendor')->first();
        if(!$vendor) {
            DB::table('users')->where('type', 'client')->where('id', 1)->update(['type' => 'vendor']);
		}
    }
}
