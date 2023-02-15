<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Worksome\RequestFactories\Concerns\HasFactory;

class SignInFormRequest extends FormRequest
{
    use HasFactory;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>['required','email:dns'],
            'password'=>['required']
        ];
    }
    public function messages()
    {
        return [
            'email' => 'is not valid email',
            'email.required' => 'email need be required',
        ];
    }

}
