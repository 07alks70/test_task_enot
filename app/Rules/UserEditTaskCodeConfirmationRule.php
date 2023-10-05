<?php

namespace App\Rules;

use App\Models\UserEditTask;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserEditTaskCodeConfirmationRule implements ValidationRule
{
    private UserEditTask $task;

    public function __construct(UserEditTask $task)
    {
        $this->task = $task;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->task->confirmation_code != $value) {
            $fail('Код неверный');
        }
    }
}
