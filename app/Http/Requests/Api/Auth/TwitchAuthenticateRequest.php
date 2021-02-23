<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $code
 * @property-read string $scope
 * @property-read string $state
 */
class TwitchAuthenticateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $sessionState = $this->session()->get('twitch_state');
        return $sessionState === $this->state;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'string'],
            'scope' => ['required', 'string'],
            'state' => ['required', 'string'],
        ];
    }
}
