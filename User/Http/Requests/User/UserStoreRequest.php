<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\User;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;
use Modules\User\Rules\SpaceRule;
use Modules\User\Rules\PhoneRule;

class UserStoreRequest extends FormRequest
{
    protected string $availableAttributes = 'user::attributes.users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required|unique:users,username|max:255',
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['nullable', 'unique:users,phone', 'min:12', 'max:13', new PhoneRule, new SpaceRule],
            'password' => ['required', new SpaceRule, 'min:6'],
            'password_confirmation' => 'required|same:password',
            'roles' => ['required', Rule::exists('roles','id')],
            'permissions' => ['nullable', Rule::exists('permissions', 'id')]
        ];
    }

    protected function prepareForValidation()
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
