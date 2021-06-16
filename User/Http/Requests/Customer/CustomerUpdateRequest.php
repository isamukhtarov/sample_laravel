<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\Customer;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;
use Modules\Image\Rules\Base64Rule;
use Modules\Image\Rules\ExtensionRule;
use Modules\Image\Rules\SizeRule;
use Modules\User\Rules\PhoneRule;

class CustomerUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        if (empty($this->id))
            return [];

        return [
            'email' => 'required|email|unique:customers,email,'.$this->id,
            'full_name' => 'nullable|max:255',
            'password' => 'nullable|string|confirmed|min:4',
            'phone' => ['required', 'unique:customers,phone,'.$this->id, 'min:12', 'max:13', new PhoneRule],
            'city' => ['nullable', 'integer', Rule::exists('cities', 'id')],
            'contacts' => 'nullable|array',
            'contacts.*' => ['min:12', 'max:13', new PhoneRule],
            'note' => 'nullable|string',
            'address' => 'nullable|string',
            'avatar' => ['nullable', new Base64Rule, new ExtensionRule(['jpg', 'jpeg', 'png']), new SizeRule(500000)],
            'email_notify_info' => 'required|array',
            'sms_notify_info' => 'required|array'
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
