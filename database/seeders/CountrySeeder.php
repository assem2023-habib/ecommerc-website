<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['country_name' => 'مصر', 'country_code' => 'EG'],
            ['country_name' => 'السعودية', 'country_code' => 'SA'],
            ['country_name' => 'الإمارات', 'country_code' => 'AE'],
            ['country_name' => 'الكويت', 'country_code' => 'KW'],
            ['country_name' => 'قطر', 'country_code' => 'QA'],
            ['country_name' => 'البحرين', 'country_code' => 'BH'],
            ['country_name' => 'عمان', 'country_code' => 'OM'],
            ['country_name' => 'الأردن', 'country_code' => 'JO'],
            ['country_name' => 'لبنان', 'country_code' => 'LB'],
            ['country_name' => 'سوريا', 'country_code' => 'SY'],
            ['country_name' => 'العراق', 'country_code' => 'IQ'],
            ['country_name' => 'فلسطين', 'country_code' => 'PS'],
            ['country_name' => 'اليمن', 'country_code' => 'YE'],
            ['country_name' => 'ليبيا', 'country_code' => 'LY'],
            ['country_name' => 'تونس', 'country_code' => 'TN'],
            ['country_name' => 'الجزائر', 'country_code' => 'DZ'],
            ['country_name' => 'المغرب', 'country_code' => 'MA'],
            ['country_name' => 'السودان', 'country_code' => 'SD'],
            ['country_name' => 'الصومال', 'country_code' => 'SO'],
            ['country_name' => 'جيبوتي', 'country_code' => 'DJ'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}