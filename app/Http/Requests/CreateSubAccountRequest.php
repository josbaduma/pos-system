<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'table_id' => 'required|integer|exists:tables,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
