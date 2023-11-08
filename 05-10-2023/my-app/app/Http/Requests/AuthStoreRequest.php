<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthStoreRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if(request()->isMethod('post')) {
            return [
                'email' => 'required|string|max:258',
                'password' => 'required|string',

            ];
        } else {
            return [
                'email' => 'required|string|max:258',
                'password' => 'required|string',
            ];
        }
    }

    public function messages()
    {
        if(request()->isMethod('post')) {
            return [
                'email.required' => 'email is required!',
                 'password.required' => 'Password is required!',

            ];
        } else {
            return [
                'email.required' => 'email is required!',
                 'password.required' => 'password is required!',

            ];
        }
    }
}
