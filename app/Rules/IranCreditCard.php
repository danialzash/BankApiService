<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IranCreditCard implements Rule
{
    public function passes($attribute, $value): bool
    {
        $cleanedValue = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cleanedValue) !== 16) {
            return false;
        }

        $sum = 0;
        $alternate = false;

        for ($i = strlen($cleanedValue) - 1; $i >= 0; $i--) {
            $num = intval($cleanedValue[$i]);

            if ($alternate) {
                $num *= 2;
                if ($num > 9) {
                    $num = (int)($num / 10) + $num % 10;
                }
            }

            $sum += $num;
            $alternate = !$alternate;
        }

        return ($sum % 10 === 0);
    }

    public function message(): string
    {
        return 'The :attribute is not a valid Iranian credit card number.';
    }
}
