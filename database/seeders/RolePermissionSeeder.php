<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'user_name' => 'admin',
                'password' => Hash::make('password'),
                'city_id' => 1, // ضع قيمة مناسبة لديك
                'gender' => 'male',
                'phone' => '123456789',
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}
