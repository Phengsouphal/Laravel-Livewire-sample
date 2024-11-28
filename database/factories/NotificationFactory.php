<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'title' =>  'Notification ' . $this->faker->name,
            'type' => Arr::random(['Normal', 'Discount', 'Wallet']),
            'description' => 'Notification is more meaning ' . $this->faker->name,
        ];
    }
}
