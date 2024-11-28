<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'title' => 'Payment to ' . $this->faker->name,
            'amount' => rand(10, 500),
            'status' => Arr::random(['success', 'processing', 'failed']),
            'date' => Carbon::now()->subDays(rand(1, 365))->startOfDay(),
        ];
    }

    public function getStatusColorAttribute()
    {
        return [
            'success' => 'green',
            'failed' => 'red',

        ][$this->status] ?? 'cool-gray';
    }

    public function getDateForHumansAttribute()
    {
        return  $this->date->format('M, d Y');
    }
}
