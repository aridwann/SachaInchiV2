<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Product::factory(200)->create();
        Product::factory()->create([
            'name' => 'Sacha Inchi Oil',
            'img' => 'img/sacha-inchi-oil.png',
            'description' => 'Minyak Sacha Inchi murni yang diekstrak dengan metode cold-pressed ini mengandung asam lemak esensial dan antioksidan tinggi. Cocok digunakan sebagai dressing salad, campuran smoothies, atau minyak pijat alami untuk melembapkan kulit. Rasakan manfaat superfood ini untuk kesehatan tubuh dan kecantikan alami Anda.',
            'price' => 60000,
        ]);
        Product::factory()->create([
            'name' => 'Sacha Inchi Seeds',
            'img' => 'img/sacha-inchi-seeds.png',
            'description' => 'Biji Sacha Inchi panggang ini renyah dan penuh nutrisi, menjadi camilan sehat dengan rasa gurih alami. Kaya Omega-3 dan protein nabati, biji ini cocok untuk topping salad, granola, atau dimakan langsung untuk menjaga energi sepanjang hari.',
            'price' => 10000,
        ]);
        Product::factory()->create([
            'name' => 'Sacha Inchi Powder',
            'img' => 'img/sacha-inchi-powder.png',
            'description' => 'Bubuk Sacha Inchi adalah sumber protein nabati berkualitas tinggi dengan rasa ringan dan nutty. Ideal sebagai campuran smoothies, yogurt, atau adonan kue sehat. Dengan kandungan asam amino esensial, bubuk ini mendukung pembentukan otot, energi, dan kesehatan pencernaan.',
            'price' => 35000,
        ]);
        Product::factory()->create([
            'name' => 'Sacha Inchi Capsules',
            'img' => 'img/sacha-inchi-capsules.png',
            'description' => 'Kapsul Sacha Inchi adalah suplemen alami kaya Omega-3, 6, dan 9 yang membantu menjaga kesehatan jantung, otak, dan kulit. Terbuat dari ekstrak biji Sacha Inchi pilihan, kapsul ini praktis dikonsumsi setiap hari untuk mendukung gaya hidup sehat dan imunitas tubuh.',
            'price' => 112000,
        ]);
        Product::factory()->create([
            'name' => 'Sacha Inchi Tea',
            'img' => 'img/sacha-inchi-tea.png',
            'description' => 'Teh Sacha Inchi terbuat dari daun Sacha Inchi pilihan yang dikeringkan alami. Memiliki aroma lembut dan rasa khas yang menenangkan, teh ini membantu relaksasi, mendukung pencernaan, serta kaya antioksidan untuk kesehatan tubuh secara menyeluruh.',
            'price' => 45000,
        ]);
        Product::factory()->create([
            'name' => 'Sacha Inchi Snacks',
            'img' => 'img/sacha-inchi-snacks.png',
            'description' => 'Sacha Inchi Snacks adalah camilan sehat berbahan dasar biji Sacha Inchi premium yang dipanggang ringan dengan bumbu alami. Kaya serat dan protein, camilan ini pas untuk Anda yang ingin ngemil tanpa rasa bersalah, sekaligus mendukung pola makan sehat.',
            'price' => 15000,
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'superadmin',
            'is_admin' => true,  
        ]);
    }
}
