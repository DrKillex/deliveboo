<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|max:150',
            'address' => 'required|max:150',
            'telephone' => 'required|max:15',
            'email' => 'nullable|max:100',
            'p_iva' => 'required|max:11',
            'description' => 'nullable',
            'opening_hours' => 'required',
            'img' => 'nullable'
        ];
    }
}
