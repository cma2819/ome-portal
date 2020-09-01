<?php

namespace App\Http\Requests\Api\Events;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $relateType
 * @property string $slug
 */
class EventUpdateRequest extends FormRequest
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
            'relateType' => ['required', 'in:moderate,support'],
            'slug' => ['required', 'string']
        ];
    }
}
