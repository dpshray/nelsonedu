<?php

namespace App\Http\Requests\Admin\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRoomRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'no_of_lectures' => ['required', 'integer', 'max:10000'],
            'enrollment_cost' => ['required', 'numeric'],
            'target_exam' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['required', 'string', 'max:2550'],
        ];
    }
}
