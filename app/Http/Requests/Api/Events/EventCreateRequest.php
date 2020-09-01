<?php

namespace App\Http\Requests\Api\Events;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $id
 * @property string $relateType
 * @property string $slug
 */
class EventCreateRequest extends FormRequest
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
            'id' => ['required', 'string'],
            'relateType' => ['required', 'in:moderate,support'],
            'slug' => ['required', 'string']
        ];
    }
}
