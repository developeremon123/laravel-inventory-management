<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['role_name'=> 'Super Admin', 'deletable'=> false],
            ['role_name'=> 'Admin', 'deletable'=> false]
        ]);
    }
}
