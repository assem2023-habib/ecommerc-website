<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'الإلكترونيات',
                'description' => 'أجهزة إلكترونية وتقنية حديثة من هواتف ذكية وحواسيب وملحقاتها',
                'slug' => 'electronics',
                'is_show' => true,
                'is_trend' => true,
            ],
            [
                'name' => 'الأزياء والموضة',
                'description' => 'ملابس وأحذية وإكسسوارات رجالية ونسائية وأطفال',
                'slug' => 'fashion',
                'is_show' => true,
                'is_trend' => true,
            ],
            [
                'name' => 'المنزل والمطبخ',
                'description' => 'أدوات منزلية ومطبخية وديكورات عصرية',
                'slug' => 'home-kitchen',
                'is_show' => true,
                'is_trend' => false,
            ],
            [
                'name' => 'الرياضة واللياقة',
                'description' => 'معدات رياضية وملابس رياضية ومكملات غذائية',
                'slug' => 'sports-fitness',
                'is_show' => true,
                'is_trend' => true,
            ],
            [
                'name' => 'الجمال والعناية',
                'description' => 'منتجات العناية بالبشرة والشعر ومستحضرات التجميل',
                'slug' => 'beauty-care',
                'is_show' => true,
                'is_trend' => false,
            ],
            [
                'name' => 'الكتب والقرطاسية',
                'description' => 'كتب ورقية وإلكترونية وأدوات مكتبية',
                'slug' => 'books-stationery',
                'is_show' => true,
                'is_trend' => false,
            ],
            [
                'name' => 'الألعاب والترفيه',
                'description' => 'ألعاب فيديو وألعاب أطفال وأدوات ترفيهية',
                'slug' => 'games-entertainment',
                'is_show' => true,
                'is_trend' => true,
            ],
            [
                'name' => 'السيارات والدراجات',
                'description' => 'قطع غيار ومستلزمات السيارات والدراجات',
                'slug' => 'automotive',
                'is_show' => true,
                'is_trend' => false,
            ],
            [
                'name' => 'الحيوانات الأليفة',
                'description' => 'طعام ومستلزمات الحيوانات الأليفة',
                'slug' => 'pets',
                'is_show' => true,
                'is_trend' => false,
            ],
            [
                'name' => 'الحدائق والهواء الطلق',
                'description' => 'أدوات البستنة ومعدات التخييم والرحلات',
                'slug' => 'garden-outdoor',
                'is_show' => false,
                'is_trend' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
