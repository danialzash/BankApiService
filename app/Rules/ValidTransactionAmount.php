<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTransactionAmount implements Rule
{
    public function passes($attribute, $value): bool
    {
        return $value > 1000 && $value < 50000000;
    }

    public function message(): string
    {
        return 'The :attribute must be between 1000 and 50,000,000 Tomans.';
    }
}
