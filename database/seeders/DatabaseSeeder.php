<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPermission;
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
        \App\Models\User::factory(100)->create();
        foreach (User::all() as $item){
            UserPermission::create(['user_id' => $item->id, 'permission' => 'only_auth', 'guard' => '[{"read": "true"}, {"store": "true"}, {"update": "true"}, {"delete": "true"}]']);
        }
    }
}
