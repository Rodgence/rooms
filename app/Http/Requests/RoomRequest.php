<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:Standard,Twin,Single,Double',
            'price' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Room name is required',
            'type.required' => 'Room type is required',
            'type.in' => 'Room type must be one of: Standard, Twin, Single, Double',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price must be at least 0',
            'max_guests.required' => 'Maximum guests is required',
            'max_guests.integer' => 'Maximum guests must be a number',
            'max_guests.min' => 'Maximum guests must be at least 1',
            'max_guests.max' => 'Maximum guests cannot exceed 10',
            'description.required' => 'Description is required',
            'image.image' => 'Uploaded file must be an image',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif',
            'image.max' => 'Image size cannot exceed 2MB',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be either active or inactive',
        ];
    }
}
