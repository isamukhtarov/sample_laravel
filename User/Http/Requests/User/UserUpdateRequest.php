<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\User;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;
use Modules\User\Entities\User;
use Modules\User\Rules\SpaceRule;
use Modules\User\Rules\PhoneRule;

class UserUpdateRequest extends FormRequest
{

    protected string $availableAttributes = 'user::attributes.users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (empty($this->id))
            return [];

        return [
            'username' => 'required|max:255|unique:users,username,'.$this->id,
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => ['nullable', 'unique:users,phone,'.$this->id, 'min:12', 'max:13', new PhoneRule, new SpaceRule],
            'password' => ['nullable', new SpaceRule, 'min:6'],
            'password_confirmation' => 'same:password',
            'roles' => ['required', Rule::exists('roles','id')],
            'permissions' => ['nullable', Rule::exists('permissions', 'id')]
        ];
    }

    protected function prepareForValidation(): void
    {
        if (empty($this->phone))
            return;

        $phone = (strpos($this->phone, '+') === 0) ? ltrim($this->phone, '+') : $this->phone;

        if ($this->has('phone')){
            $this->merge([
                'phone' => $phone
            ]);
        }
    }
}
