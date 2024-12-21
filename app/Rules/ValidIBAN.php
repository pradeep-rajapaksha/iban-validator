<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIBAN implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // removing spaces and convert to uppercase
        $iban = strtoupper(str_replace(' ', '', $value));

        // basic IBAN length check (Min: 15, Max: 34)
        if (strlen($iban) < 15 || strlen($iban) > 34) {
            $fail('The :attribute must be length between 15 and 34.');
        }

        // move the first four characters to the end
        $reformattedIban = substr($iban, 4) . substr($iban, 0, 4);

        // replace letters with numbers (A=10, B=11, ..., Z=35)
        $numericIban = '';
        foreach (str_split($reformattedIban) as $char) {
            $numericIban .= is_numeric($char) ? $char : ord($char) - 55;
        }

        // check if the IBAN is valid using the mod-97 algorithm
        if (bcmod($numericIban, '97') != 1) {
            $fail('The :attribute must be valid.');
        }
    }
}
