<?php

namespace App\Http\Requests\Api\Schemes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string|null $startAt
 * @property string|null $endAt
 * @property string $explanation
 */
class SchemeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'startAt' => ['nullable', 'date'],
            'endAt' => ['nullable', 'date'],
            'explanation' => ['required', 'string']
        ];
    }
}
