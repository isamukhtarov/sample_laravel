<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\Role;

use Modules\Core\Http\Requests\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function rules(): array
    {
        if (empty($this->id))
            return [];

         $rules = [
             'display_name' => 'required|array',
             'name' => 'required|max:20|unique:roles,name,'.$this->id,
             'color' => 'nullable|max:20'
         ];

         foreach (config('app.languages') as $lang) {
             $rules['display_name.' . $lang] = 'required|max:255';
         }

        return $rules;
    }

}
