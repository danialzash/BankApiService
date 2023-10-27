<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Models\User;
use Database\Factories\TransactionFeeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(50)->create();
         Account::factory(100)->create();
         Card::factory(100)->create();
         Transaction::factory(500)->create();
         TransactionFee::factory(500)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
