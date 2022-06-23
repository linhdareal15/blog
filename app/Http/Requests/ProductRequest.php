<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => ['required', 'max:10'],
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price'=>['required','numeric','max:500000'],
            'quantity' => ['required','numeric','max:1000','min:1'],
            'sub_category_id' => ['required'],
            'sale' => ['required','numeric','min:0','max:1'],
            'status' => ['required','numeric'],
            'photo' => ['required','image'],
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Code is required!',
            'name.required' => 'Name is required!',
            'price.max' => 'Price is not higher than 500000',
            'quantity.min' => 'Quantity is not be 0',
            'quantity.max' => "Quantity is not higher than 1000",
            'sale.min' => "Sale's min: 0",
            'sale.max' => "Sale's max: 1",
            'photo.image' => "File not support"
        ];
    }
}
