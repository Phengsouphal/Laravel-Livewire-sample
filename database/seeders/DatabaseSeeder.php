<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Notification;
use App\Models\Plants;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'ddd@example.com',
            'password' => Hash::make('dddddd'),
        ]);
        Transaction::factory()->count(100)->create();

        Plants::factory()->count(150)->create();
        Notification::factory()->count(100)->create();
    }
}
