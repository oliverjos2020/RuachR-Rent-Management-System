<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(7, 10);
        $slug = Str::slug($title);
        return [
            
                'user_id' => $this->faker->numberBetween(1, 11),
                'title' => $title,
                'slug' => $slug,
                'short_description' => $this->faker->text(200),
                'description' => $this->faker->text(500),
                'regular_price' => $this->faker->numberBetween(500, 10000),
                'sale_price' => $this->faker->numberBetween(300, 5000),
                'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(100, 500),
                'stock_status' => 'instock',
                'featured' => $this->faker->numberBetween(0, 1),
                'quantity' => $this->faker->numberBetween(100, 200),
                // 'featured_image' => 'product-'.$this->faker->numberBetween(1, 25).'.jpg',
                'featured_image' => $this->faker->imageUrl('400','400'),
                'is_illustrator' => $this->faker->numberBetween(0, 1),
                // 'featured' => $this->faker->numberBetween(0, 1),
            
        ];
    }
}
