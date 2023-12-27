<?php

namespace Crm\Project\Requests;

use Crm\Base\Requests\ApiRequest;

class CreateProject extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'status' => 'required|numeric',
            'cost' => 'required|numeric'
        ];
    }
}
