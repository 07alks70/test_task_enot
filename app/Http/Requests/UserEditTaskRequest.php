<?php

namespace App\Http\Requests;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Rules\SendingServiceValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserEditTaskRequest extends FormRequest
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
        return [
            'name' => 'string',
            'email' => 'string',
            'city' => 'string',
            'citizenship' => 'string',
            'password' => 'string',
            'message_service' => ['required', 'numeric', new SendingServiceValidationRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Свойство должно иметь тип строки',
            'email.string' => 'Свойство должно иметь тип строки',
            'city.string' => 'Свойство должно иметь тип строки',
            'citizenship.string' => 'Свойство должно иметь тип строки',
            'password.string' => 'Свойство должно иметь тип строки',
            'message_service.required' => 'Свойство обязательное',
            'message_service.string' => 'Свойство должно иметь тип строки',
            'message_service.numeric' => 'Свойство должно быть числом',
        ];
    }

    public function toUserDTO(User $user): UserDTO
    {
        $this->json('message_service');

        if ($this->json('password')) {
            if (Hash::check($this->json('password'), $user->password)) {
                $password = $this->json('password');
            } else {
                $password = $user->password;
            }
        } else {
            $password = $user->password;
        }

        return new UserDTO(
            name: (! $this->json('name')) ? $user->name : $this->json('name'),
            userId: $user->id,
            password: $password,
            city: (! $this->json('city')) ? $user->city : $this->json('city'),
            email: (! $this->json('email')) ? $user->email : $this->json('email'),
            citizenship: (! $this->json('citizenship')) ? $user->citizenship : $this->json('citizenship'),
        );
    }
}
