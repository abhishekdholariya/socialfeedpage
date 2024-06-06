<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'message' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages()
    {
        return [
            'message.required' => 'Message is required',
            'img.required' => 'image is required',
            'img.image' => 'Image must be a valid image file',
            'img.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
        ];
    }
}
