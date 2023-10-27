<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fromCard = Card::inRandomOrder()->first();
        $toCard = Card::where('id', '!=', $fromCard->id)->inRandomOrder()->first();

        return [
            'from_card' => $fromCard->id,
            'to_card' => $toCard->id,
            'amount' => $this->faker->numberBetween(1000, 50000000),
        ];
    }
}
