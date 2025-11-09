<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // مصر (ID: 1)
            ['city_name' => 'القاهرة', 'country_id' => 1],
            ['city_name' => 'الإسكندرية', 'country_id' => 1],
            ['city_name' => 'الجيزة', 'country_id' => 1],
            ['city_name' => 'الأقصر', 'country_id' => 1],
            ['city_name' => 'أسوان', 'country_id' => 1],

            // السعودية (ID: 2)
            ['city_name' => 'الرياض', 'country_id' => 2],
            ['city_name' => 'جدة', 'country_id' => 2],
            ['city_name' => 'مكة المكرمة', 'country_id' => 2],
            ['city_name' => 'المدينة المنورة', 'country_id' => 2],
            ['city_name' => 'الدمام', 'country_id' => 2],

            // الإمارات (ID: 3)
            ['city_name' => 'دبي', 'country_id' => 3],
            ['city_name' => 'أبوظبي', 'country_id' => 3],
            ['city_name' => 'الشارقة', 'country_id' => 3],
            ['city_name' => 'العين', 'country_id' => 3],
            ['city_name' => 'رأس الخيمة', 'country_id' => 3],

            // الكويت (ID: 4)
            ['city_name' => 'مدينة الكويت', 'country_id' => 4],
            ['city_name' => 'الجهراء', 'country_id' => 4],
            ['city_name' => 'الأحمدي', 'country_id' => 4],
            ['city_name' => 'حولي', 'country_id' => 4],

            // قطر (ID: 5)
            ['city_name' => 'الدوحة', 'country_id' => 5],
            ['city_name' => 'الوكرة', 'country_id' => 5],
            ['city_name' => 'الريان', 'country_id' => 5],

            // البحرين (ID: 6)
            ['city_name' => 'المنامة', 'country_id' => 6],
            ['city_name' => 'المحرق', 'country_id' => 6],
            ['city_name' => 'الرفاع', 'country_id' => 6],

            // عمان (ID: 7)
            ['city_name' => 'مسقط', 'country_id' => 7],
            ['city_name' => 'صلالة', 'country_id' => 7],
            ['city_name' => 'صحار', 'country_id' => 7],

            // الأردن (ID: 8)
            ['city_name' => 'عمان', 'country_id' => 8],
            ['city_name' => 'إربد', 'country_id' => 8],
            ['city_name' => 'الزرقاء', 'country_id' => 8],
            ['city_name' => 'العقبة', 'country_id' => 8],

            // لبنان (ID: 9)
            ['city_name' => 'بيروت', 'country_id' => 9],
            ['city_name' => 'طرابلس', 'country_id' => 9],
            ['city_name' => 'صيدا', 'country_id' => 9],

            // سوريا (ID: 10)
            ['city_name' => 'دمشق', 'country_id' => 10],
            ['city_name' => 'حلب', 'country_id' => 10],
            ['city_name' => 'حمص', 'country_id' => 10],

            // العراق (ID: 11)
            ['city_name' => 'بغداد', 'country_id' => 11],
            ['city_name' => 'البصرة', 'country_id' => 11],
            ['city_name' => 'الموصل', 'country_id' => 11],
            ['city_name' => 'أربيل', 'country_id' => 11],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
