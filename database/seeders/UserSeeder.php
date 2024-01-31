<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id'=> 1,
            'name'=>'Md Emon',
            'email'=> 'mail.emon.bd123@gmail.com',
            'mobile_no'=> '01944393357',
            'gender'=> 1,
            'password'=> 'M@il.Em0n'
        ]);
    }
}
