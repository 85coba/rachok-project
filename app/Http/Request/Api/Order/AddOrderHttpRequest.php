<?php

declare(strict_types=1);

namespace App\Http\Request\Api\Order;

use App\Http\Request\ApiFormRequest;

final class AddOrderHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'info' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required'
        ];
    }
}