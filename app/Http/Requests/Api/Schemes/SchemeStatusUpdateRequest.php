<?php

namespace App\Http\Requests\Api\Schemes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $status
 * @property-read string $reply
 */
class SchemeStatusUpdateRequest extends FormRequest
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
            'status' => ['required', 'string'],
            'reply' => ['required', 'string'],
        ];
    }
}
