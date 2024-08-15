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
    public function run()
    {
        if (Role::query()->exists()) {
            return false;
        }
        $defaultRoles = [
            [
                'id'    => Role::SUPER_ADMIN,
                'name' => 'Super Admin',
                'slug' => 'super_admin',
            ],
            [
                'id'    => Role::ADMIN,
                'name' => 'Admin',
                'slug' => 'admin',
            ],
        ];
        Role::query()->insert($defaultRoles);
        return true;
    }
}
