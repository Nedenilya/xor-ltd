<?php

namespace App\Containers\AppSection\User\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends ParentSeeder
{
    public function run(): void
    {
        if (app()->runningUnitTests()) {
            return;
        }

        $managerId = DB::table('users')->insertGetId([
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ([1, 2] as $i) {
            DB::table('users')->insert([
                'email' => "employee$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'employee',
                'manager_id' => $managerId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 