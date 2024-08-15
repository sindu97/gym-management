<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): bool
    {
        if (User::exists()) {
            return false;
        }
        $faker = Factory::create();
        $user = new User();
        $user->name = $faker->name;
        $user->email = 'company_admin@yopmail.com';
        $user->password = Hash::make('Test@1234');
        $user->save();
        return true;
    }
}
