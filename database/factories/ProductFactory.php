<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Bezhanov\Faker\ProviderCollectionHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        ProviderCollectionHelper::addAllProvidersTo($faker);

        return [
            'name' => $faker->unique()->productName,
            'image' => "https://www.fraction9coffee.com/cdn/shop/t/23/assets/placeholder_1080x.png?v=113555733946226816651714543406",
            'description' => $faker->words(2, true),
            'status' => 'active',
            'quantity' => $faker->numberBetween(50, 100),
            'price' => $faker->numberBetween(100, 200),
            'compare_price' => $faker->numberBetween(201, 500),
            'category_id' => Category::inRandomOrder()->first('id'),
            'store_id' => Store::inRandomOrder()->first('id'),
        ];
    }
}
