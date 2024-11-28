<?php

namespace Database\Factories;

use App\Models\Plants;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantsFactory extends Factory
{
    protected $model = Plants::class;

    public function definition()
    {
        return [
            'title' => $this->faker->name . ' Plants ',
            'price' => rand(10, 500),
            'stock' => rand(2, 50),
            'description' => 'Plants is more meaning ' . $this->faker->name,
        ];
    }
}
