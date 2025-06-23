<?php

namespace App\Containers\AppSection\Auth\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends ParentSeeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['name' => 'manager', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'employee', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
} 