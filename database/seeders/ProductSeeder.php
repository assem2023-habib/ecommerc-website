<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // الإلكترونيات (Category ID: 1)
            [
                'name' => 'هاتف سامسونج جالاكسي S24',
                'description' => 'هاتف ذكي بشاشة 6.2 بوصة، معالج قوي، كاميرا 50 ميجابكسل، بطارية 4000 مللي أمبير، نظام أندرويد 14',
                'short_description' => 'هاتف سامسونج الرائد بأحدث التقنيات',
                'price' => 3999.99,
                'stock' => 50,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 1,
            ],
            [
                'name' => 'لابتوب ديل XPS 15',
                'description' => 'حاسوب محمول بمعالج Intel Core i7 الجيل 13، رام 16 جيجا، هارد SSD 512 جيجا، شاشة 4K، كرت شاشة NVIDIA RTX 4050',
                'short_description' => 'لابتوب احترافي للعمل والإبداع',
                'price' => 7999.99,
                'stock' => 25,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 1,
            ],
            [
                'name' => 'سماعات أبل AirPods Pro',
                'description' => 'سماعات لاسلكية بخاصية إلغاء الضوضاء، مقاومة للماء، عمر البطارية 6 ساعات، علبة شحن لاسلكية',
                'short_description' => 'سماعات بأفضل جودة صوت',
                'price' => 999.99,
                'stock' => 100,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 1,
            ],

            // الأزياء والموضة (Category ID: 2)
            [
                'name' => 'قميص رجالي قطن',
                'description' => 'قميص رسمي من القطن 100%، متوفر بعدة مقاسات وألوان، مناسب للعمل والمناسبات الرسمية',
                'short_description' => 'قميص أنيق ومريح للاستخدام اليومي',
                'price' => 149.99,
                'stock' => 200,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 2,
            ],
            [
                'name' => 'فستان نسائي صيفي',
                'description' => 'فستان من القماش الخفيف، تصميم عصري، مناسب للصيف، متوفر بألوان زاهية',
                'short_description' => 'فستان مثالي للأيام الدافئة',
                'price' => 249.99,
                'stock' => 80,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 2,
            ],
            [
                'name' => 'حذاء رياضي نايكي',
                'description' => 'حذاء رياضي مريح بتقنية Air Zoom، نعل مرن، تصميم عصري، مناسب للجري والرياضة',
                'short_description' => 'حذاء رياضي عالي الجودة',
                'price' => 599.99,
                'stock' => 60,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 2,
            ],

            // المنزل والمطبخ (Category ID: 3)
            [
                'name' => 'خلاط كهربائي فيليبس',
                'description' => 'خلاط بقوة 700 واط، وعاء زجاجي 1.5 لتر، 5 سرعات مختلفة، شفرات من الستانلس ستيل',
                'short_description' => 'خلاط قوي لجميع احتياجات المطبخ',
                'price' => 349.99,
                'stock' => 40,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 3,
            ],
            [
                'name' => 'طقم أواني طبخ',
                'description' => 'طقم 10 قطع من الستانلس ستيل، مقاومة للصدأ، مناسبة لجميع أنواع المواقد بما فيها الحث المغناطيسي',
                'short_description' => 'طقم أواني عالي الجودة',
                'price' => 799.99,
                'stock' => 30,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 3,
            ],

            // الرياضة واللياقة (Category ID: 4)
            [
                'name' => 'دمبل قابل للتعديل',
                'description' => 'دمبل بأوزان قابلة للتعديل من 2 إلى 24 كجم، مثالي للتمارين المنزلية، طلاء مقاوم للصدأ',
                'short_description' => 'معدات تمرين متعددة الاستخدامات',
                'price' => 499.99,
                'stock' => 35,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 4,
            ],
            [
                'name' => 'حصيرة يوغا',
                'description' => 'حصيرة بسمك 6 مم، مصنوعة من مواد صديقة للبيئة، مضادة للانزلاق، تأتي مع حقيبة نقل',
                'short_description' => 'حصيرة مثالية لليوغا والتمارين',
                'price' => 129.99,
                'stock' => 70,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 4,
            ],

            // الجمال والعناية (Category ID: 5)
            [
                'name' => 'كريم مرطب للوجه',
                'description' => 'كريم بتركيبة خفيفة غنية بالفيتامينات، مناسب لجميع أنواع البشرة، يرطب لمدة 24 ساعة',
                'short_description' => 'ترطيب عميق للبشرة',
                'price' => 179.99,
                'stock' => 90,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 5,
            ],
            [
                'name' => 'شامبو للشعر الجاف',
                'description' => 'شامبو بزيت الأرجان والكيراتين، يعيد الحيوية للشعر الجاف والتالف، خالي من السلفات',
                'short_description' => 'عناية مثالية للشعر الجاف',
                'price' => 89.99,
                'stock' => 120,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 5,
            ],

            // الكتب والقرطاسية (Category ID: 6)
            [
                'name' => 'دفتر ملاحظات جلد',
                'description' => 'دفتر بغلاف جلدي فاخر، 200 صفحة، ورق عالي الجودة، مناسب للكتابة اليومية والرسم',
                'short_description' => 'دفتر أنيق للملاحظات',
                'price' => 79.99,
                'stock' => 150,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 6,
            ],
            [
                'name' => 'رواية عربية - الأرض اليباب',
                'description' => 'رواية أدبية مشوقة من تأليف كاتب عربي مشهور، طبعة جديدة محدثة',
                'short_description' => 'رواية أدبية رائعة',
                'price' => 59.99,
                'stock' => 200,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 6,
            ],

            // الألعاب والترفيه (Category ID: 7)
            [
                'name' => 'بلايستيشن 5',
                'description' => 'جهاز ألعاب من الجيل الجديد، معالج قوي، رسومات 4K، يدعى Ray Tracing، يأتي مع يد تحكم لاسلكية',
                'short_description' => 'أفضل تجربة ألعاب على الإطلاق',
                'price' => 2499.99,
                'stock' => 20,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 7,
            ],
            [
                'name' => 'مكعب روبيك',
                'description' => 'مكعب كلاسيكي للألغاز، مصنوع من بلاستيك عالي الجودة، حركة سلسة، مناسب لجميع الأعمار',
                'short_description' => 'لعبة ذكاء كلاسيكية',
                'price' => 39.99,
                'stock' => 300,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 7,
            ],

            // السيارات والدراجات (Category ID: 8)
            [
                'name' => 'زيت محرك موبيل 1',
                'description' => 'زيت محرك صناعي كامل، يوفر حماية عالية للمحرك، مناسب لجميع أنواع السيارات',
                'short_description' => 'زيت محرك عالي الجودة',
                'price' => 199.99,
                'stock' => 300,
                'discount' => 0.00,
                'is_show' => true,
                'category_id' => 7,
            ]
        ];

        foreach ($products as $city) {
            Product::create($city);
        }
    }
}
