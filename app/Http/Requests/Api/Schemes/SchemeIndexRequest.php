<?php

namespace App\Http\Requests\Api\Schemes;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int|null $planner
 * @property string[]|null $status
 * @property string|null $startAt
 * @property string|null $endAt
 */
class SchemeIndexRequest extends FormRequest
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
            'planner' => ['nullable', 'numeric'],
            'status' => ['nullable', 'array'],
            'status.*' => ['string'],
            'startAt' => ['nullable', 'date'],
            'endAt' => ['nullable', 'date'],
        ];
    }
}
