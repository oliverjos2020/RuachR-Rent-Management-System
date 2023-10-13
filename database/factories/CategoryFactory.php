<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = $this->faker->unique()->randomElement(['Bag','Shoes', 'Glasses', 'Clothes', 'Fashion', 'Hub', 'Jean', 'Shirt', 'Skirt', 'Lipstick', 'Sweater', 'Makeup']);
        $slug = $slug = Str::slug($category);
        return [
            'name' => $category,
            'slug' => $slug,
            'category_image' => 'product-'.$this->faker->numberBetween(1, 25).'.jpg',
            'featured' => $this->faker->numberBetween(0, 1),
        ];
    }
}
