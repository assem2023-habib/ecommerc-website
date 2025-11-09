<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'أحمد محمد',
                'user_name' => 'ahmed_mohamed',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1990-05-15',
                'gender' => 'male',
                'phone' => '+201012345678',
                'city_id' => 1, // القاهرة
            ],
            [
                'name' => 'فاطمة علي',
                'user_name' => 'fatima_ali',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1995-08-20',
                'gender' => 'female',
                'phone' => '+966512345678',
                'city_id' => 6, // الرياض
            ],
            [
                'name' => 'محمد خالد',
                'user_name' => 'mohamed_khaled',
                'email' => 'mohamed@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1988-03-10',
                'gender' => 'male',
                'phone' => '+971501234567',
                'city_id' => 11, // دبي
            ],
            [
                'name' => 'سارة أحمد',
                'user_name' => 'sara_ahmed',
                'email' => 'sara@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1992-12-25',
                'gender' => 'female',
                'phone' => '+201112345678',
                'city_id' => 2, // الإسكندرية
            ],
            [
                'name' => 'عمر حسن',
                'user_name' => 'omar_hassan',
                'email' => 'omar@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1985-07-30',
                'gender' => 'male',
                'phone' => '+96599123456',
                'city_id' => 16, // مدينة الكويت
            ],
            [
                'name' => 'ليلى محمود',
                'user_name' => 'layla_mahmoud',
                'email' => 'layla@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1998-02-14',
                'gender' => 'female',
                'phone' => '+97444123456',
                'city_id' => 20, // الدوحة
            ],
            [
                'name' => 'يوسف إبراهيم',
                'user_name' => 'youssef_ibrahim',
                'email' => 'youssef@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1993-11-08',
                'gender' => 'male',
                'phone' => '+96899123456',
                'city_id' => 26, // مسقط
            ],
            [
                'name' => 'نور الدين',
                'user_name' => 'nour_aldin',
                'email' => 'nour@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1991-04-22',
                'gender' => 'male',
                'phone' => '+962791234567',
                'city_id' => 29, // عمان
            ],
            [
                'name' => 'مريم سالم',
                'user_name' => 'mariam_salem',
                'email' => 'mariam@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1996-09-17',
                'gender' => 'female',
                'phone' => '+96171123456',
                'city_id' => 33, // بيروت
            ],
            [
                'name' => 'خالد عبدالله',
                'user_name' => 'khaled_abdullah',
                'email' => 'khaled@example.com',
                'password' => Hash::make('password123'),
                'birthday' => '1987-06-05',
                'gender' => 'male',
                'phone' => '+966512345679',
                'city_id' => 7, // جدة
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
