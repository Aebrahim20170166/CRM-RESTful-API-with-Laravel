<?php

namespace Crm\User\Request;

use Crm\Base\Requests\ApiRequest;

class UserCreation extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|min:3|unique:users,name",
            "email" => "required|unique:users,email",
            "password" => "required|min:6"

        ];
    }
}
