<?php

// use App\Models\RoleUser;
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory
{

    protected $model = RoleUser::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id' => $this->faker->numberBetween(2, 2),
            'user_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
