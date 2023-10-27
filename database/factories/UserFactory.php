<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'mobile' => $this->generateUniqueIranianMobileNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Fake Iran Mobile Random Number
     * @return string
     */
    private function generateUniqueIranianMobileNumber(): string
    {
        $prefixes = ['0910', '0911', '0912', '0913', '0914', '0915', '0916', '0917', '0918', '0919',
            '0930', '0933', '0935', '0936', '0937', '0938', '0939',
            '0901', '0902', '0903', '0904', '0905', '0906', '0907', '0908', '0909'];

        do {
            $randomPrefix = $prefixes[array_rand($prefixes)];
            $randomDigits = mt_rand(1000000, 9999999);
            $mobileNumber = $randomPrefix . $randomDigits;
        } while (User::where('mobile', $mobileNumber)->exists());

        return $mobileNumber;
    }
}
