<?php

namespace App\Http\Requests;

use App\Models\UserEditTask;
use App\Rules\UserEditTaskCodeConfirmationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserConfirmationTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /**
         * @var $task UserEditTask
         */
        $task = $this->route()->parameter("task");
        return [
            "code" => ["required", "numeric", "digits:4", new UserEditTaskCodeConfirmationRule($task)]
        ];
    }

    public function messages()
    {
        return [
            "code.string" => "Свойство обязательное",
            "code.numeric" => "Свойство должно быть числом",
            "code.digits" => "Свойство должно иметь 4 цифры",
        ];
    }
}
