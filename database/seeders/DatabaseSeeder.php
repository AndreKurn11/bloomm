<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks dulu sebelum truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Menu::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ── CATEGORIES ────────────────────────────────────────────────
        $categories = [
            ['name' => 'Semua Menu',          'slug' => 'semua',              'icon' => ''],
            ['name' => 'Coffee Specialities', 'slug' => 'coffee-specialities', 'icon' => ''],
            ['name' => 'Non Coffee',          'slug' => 'non-coffee',         'icon' => ''],
            ['name' => 'Mocktail & Squash',   'slug' => 'mocktail-squash',    'icon' => ''],
            ['name' => 'Main Course',         'slug' => 'main-course',        'icon' => ''],
            ['name' => 'Pasta',               'slug' => 'pasta',              'icon' => ''],
            ['name' => 'Snack',               'slug' => 'snack',              'icon' => ''],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $coffee    = Category::where('slug', 'coffee-specialities')->first();
        $nonCoffee = Category::where('slug', 'non-coffee')->first();
        $mocktail  = Category::where('slug', 'mocktail-squash')->first();
        $mainCourse = Category::where('slug', 'main-course')->first();
        $pasta     = Category::where('slug', 'pasta')->first();
        $snack     = Category::where('slug', 'snack')->first();

        // ── KOPI ──────────────────────────────────────────────────────
        $coffeeItems = [
            [
                'name' => 'American Peach',
                'slug' => 'american-peach',
                'description' => 'Perpaduan kopi segar dengan sentuhan rasa peach yang manis dan menyegarkan.',
                'price' => 22000,
                'image' => 'American-Peach.png',
                'badge' => null,
            ],
            [
                'name' => 'Americano',
                'slug' => 'americano',
                'description' => 'Espresso yang dipadukan dengan air panas menghasilkan rasa kopi yang kuat dan bersih.',
                'price' => 18000,
                'image' => 'Americano.png',
                'badge' => null,
            ],
            [
                'name' => 'Blooming Choco Ice Cream',
                'slug' => 'blooming-choco-ice-cream',
                'description' => 'Minuman kopi cokelat dengan topping es krim yang creamy dan nikmat.',
                'price' => 29000,
                'image' => 'Blooming-choco-ice-cream.png',
                'badge' => 'BEST SELLER',
            ],
            [
                'name' => 'Blooming Matcha Ice Cream',
                'slug' => 'blooming-matcha-ice-cream',
                'description' => 'Perpaduan matcha premium dengan es krim lembut yang menyegarkan.',
                'price' => 29000,
                'image' => 'Blooming-Matcha-ice-cream.png',
                'badge' => null,
            ],
            [
                'name' => 'Blooming OG Latte',
                'slug' => 'blooming-og-latte',
                'description' => 'Signature latte khas Bloom dengan rasa creamy dan aroma kopi yang seimbang.',
                'price' => 26000,
                'image' => 'Blooming-OG-Latte.png',
                'badge' => 'FAVORITE',
            ],
            [
                'name' => 'Blooming Palm Sugar Latte',
                'slug' => 'blooming-palm-sugar-latte',
                'description' => 'Latte dengan gula aren pilihan yang manis alami dan kaya rasa.',
                'price' => 20000,
                'image' => 'Blooming-Palm-Sugar-Latte.png',
                'badge' => null,
            ],
        ];

        foreach ($coffeeItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $coffee->id]));
        }

        // ── NON-KOPI ──────────────────────────────────────────────────
        $nonCoffeeItems = [
            [
                'name' => 'Choco Bloomshake',
                'slug' => 'choco-bloomshake',
                'description' => 'Milkshake cokelat creamy dengan rasa yang kaya dan memanjakan.',
                'price' => 28000,
                'image' => 'Choco-Bloomshake.png',
                'badge' => null,
            ],
            [
                'name' => 'Chocolate',
                'slug' => 'chocolate',
                'description' => 'Minuman cokelat hangat atau dingin dengan cita rasa premium.',
                'price' => 25000,
                'image' => 'Chocolatte.png',
                'badge' => null,
            ],
            [
                'name' => 'Lemon Tea',
                'slug' => 'lemon-tea',
                'description' => 'Teh lemon segar yang cocok dinikmati kapan saja.',
                'price' => 22000,
                'image' => 'Lemon-Tea.png',
                'badge' => null,
            ],
            [
                'name' => 'Lychee Tea',
                'slug' => 'lychee-tea',
                'description' => 'Perpaduan teh dan rasa leci yang manis serta menyegarkan.',
                'price' => 22000,
                'image' => 'Lychee-tea.png',
                'badge' => null,
            ],
            [
                'name' => 'Lychee Yakult',
                'slug' => 'lychee-yakult',
                'description' => 'Minuman leci dengan Yakult yang segar dan ringan.',
                'price' => 24000,
                'image' => 'Lychee-Yakult.png',
                'badge' => 'NEW',
            ],
            [
                'name' => 'Matcha Bloomshake',
                'slug' => 'matcha-bloomshake',
                'description' => 'Milkshake matcha creamy dengan aroma khas teh hijau Jepang.',
                'price' => 28000,
                'image' => 'Matcha-Bloomshake.png',
                'badge' => null,
            ],
        ];

        foreach ($nonCoffeeItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $nonCoffee->id]));
        }

        // ── Mocktail and Squash ────────────────────────────────────────────
        $mocktailItems = [
            [
                'name' => 'Blue Ocean',
                'slug' => 'blue-ocean',
                'description' => 'Mocktail segar berwarna biru dengan rasa tropis yang ringan.',
                'price' => 25000,
                'image' => 'Blue-Ocean.png',
                'badge' => null,
            ],
            [
                'name' => 'Blue Sky',
                'slug' => 'blue-sky',
                'description' => 'Minuman menyegarkan dengan perpaduan rasa manis dan citrus.',
                'price' => 25000,
                'image' => 'Blue-Sky.png',
                'badge' => null,
            ],
            [
                'name' => 'Lychee Squash',
                'slug' => 'lychee-squash',
                'description' => 'Leci segar dengan soda yang memberikan sensasi sparkling.',
                'price' => 24000,
                'image' => 'Lychee-squash.png',
                'badge' => null,
            ],
            [
                'name' => 'Melon Squash',
                'slug' => 'melon-squash',
                'description' => 'Minuman melon dengan soda dingin yang menyegarkan.',
                'price' => 24000,
                'image' => 'Melon-Squash.png',
                'badge' => null,
            ],
            [
                'name' => 'Yakult Illusion',
                'slug' => 'yakult-illusion',
                'description' => 'Perpaduan Yakult dan buah segar dengan rasa unik dan menyenangkan.',
                'price' => 25000,
                'image' => 'Yakult-Illusion.png',
                'badge' => 'FAVORITE',
            ],
        ];

        foreach ($mocktailItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $mocktail->id]));
        }

        $mainCourseItems = [
            [
                'name' => 'Ayam Djontor',
                'slug' => 'ayam-djontor',
                'description' => 'Ayam goreng dengan sambal khas yang pedas dan menggugah selera.',
                'price' => 26000,
                'image' => 'Ayam-djontor.png',
                'badge' => null,
            ],
            [
                'name' => 'Ayam Geprek',
                'slug' => 'ayam-geprek',
                'description' => 'Ayam crispy yang digeprek dengan sambal pilihan.',
                'price' => 25000,
                'image' => 'Ayam-Geprek.png',
                'badge' => null,
            ],
            [
                'name' => 'Nasi Goreng Spesial',
                'slug' => 'nasi-goreng-spesial',
                'description' => 'Nasi goreng dengan bumbu khas dan topping melimpah.',
                'price' => 25000,
                'image' => 'Nasi-Goreng-Spesial.png',
                'badge' => 'BEST SELLER',
            ],
            [
                'name' => 'RB Chicken Black Pepper',
                'slug' => 'rb-chicken-black-pepper',
                'description' => 'Ayam dengan saus black pepper yang gurih dan kaya rasa.',
                'price' => 27000,
                'image' => 'RB-Chicken-Black-Papper.png',
                'badge' => null,
            ],
        ];

        foreach ($mainCourseItems as $item) {
            Menu::create(array_merge($item, [
                'category_id' => $mainCourse->id
            ]));
        }

        $pastaItems = [
            [
                'name' => 'Aglio Olio',
                'slug' => 'aglio-olio',
                'description' => 'Pasta klasik dengan bawang putih dan olive oil.',
                'price' => 22000,
                'image' => 'Aglio-olio.png',
                'badge' => null,
            ],
            [
                'name' => 'Bolognese',
                'slug' => 'bolognese',
                'description' => 'Pasta dengan saus tomat dan daging yang kaya rasa.',
                'price' => 22000,
                'image' => 'Bolognese.png',
                'badge' => null,
            ],
            [
                'name' => 'Carbonara',
                'slug' => 'carbonara',
                'description' => 'Pasta creamy dengan cita rasa gurih yang lembut.',
                'price' => 22000,
                'image' => 'Carbonara.png',
                'badge' => 'FAVORITE',
            ],
            [
                'name' => 'Mie Goreng Special',
                'slug' => 'mie-goreng-special',
                'description' => 'Mie goreng dengan topping spesial dan bumbu khas.',
                'price' => 22000,
                'image' => 'mie-goreng-special.png',
                'badge' => null,
            ],
            [
                'name' => 'Mie Goreng Telur',
                'slug' => 'mie-goreng-telur',
                'description' => 'Mie goreng sederhana dengan tambahan telur.',
                'price' => 18000,
                'image' => 'mie-goreng-telur.png',
                'badge' => null,
            ],
            [
                'name' => 'Mie Rebus Special',
                'slug' => 'mie-rebus-special',
                'description' => 'Mie rebus hangat dengan topping spesial.',
                'price' => 22000,
                'image' => 'mie-rebus-special.png',
                'badge' => null,
            ],
            [
                'name' => 'Mie Rebus Telur',
                'slug' => 'mie-rebus-telur',
                'description' => 'Mie rebus dengan telur dan kuah gurih.',
                'price' => 18000,
                'image' => 'mie-rebus-telur.png',
                'badge' => null,
            ],
        ];

        foreach ($pastaItems as $item) {
            Menu::create(array_merge($item, [
                'category_id' => $pasta->id
            ]));
        }

        $snackItems = [
            [
                'name' => 'Cheesy Banana',
                'slug' => 'cheesy-banana',
                'description' => 'Pisang goreng renyah dengan topping keju melimpah dan saus manis.',
                'price' => 26000,
                'image' => 'Cheesy-banana.png',
                'is_available' => true,
            ],
            [
                'name' => 'Chicken Karage',
                'slug' => 'chicken-karage',
                'description' => 'Potongan ayam crispy khas Jepang dengan bumbu gurih yang menggugah selera.',
                'price' => 24000,
                'image' => 'Chicken-Karage.png',
                'is_available' => true,
            ],
            [
                'name' => 'Choco Nana Bliss',
                'slug' => 'choco-nana-bliss',
                'description' => 'Perpaduan pisang dan cokelat yang manis, lembut, dan memanjakan lidah.',
                'price' => 26000,
                'image' => 'Choco-nana-bliss.png',
                'is_available' => true,
            ],
            [
                'name' => 'French Fries',
                'slug' => 'french-fries',
                'description' => 'Kentang goreng renyah dengan taburan bumbu pilihan.',
                'price' => 20000,
                'image' => 'french-fries.png',
                'is_available' => true,
            ],
        ];

        foreach ($snackItems as $item) {
            Menu::create(array_merge($item, [
                'category_id' => $snack->id
            ]));
        }
    }
}
