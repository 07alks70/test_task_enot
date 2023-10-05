<?php

namespace App\Rules;

use App\Enums\SendingServiceEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SendingServiceValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sendingServiceEnum = SendingServiceEnum::tryFrom($value);

        if ($sendingServiceEnum == null) {
            $fail('Выберите сервис: Telagram-'.SendingServiceEnum::TELEGRAM->value.', Email-'.SendingServiceEnum::EMAIL->value.', Sms-'.SendingServiceEnum::SMS->value);
        }
    }
}
