<?php

namespace App\Http\Requests\Teacher\StudyMaterial;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StudyMaterialStoreRequest extends FormRequest
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
            'file' => ['sometimes', 'nullable', 'array', 'min:1'],
            'file.*' => ['sometimes', 'nullable', File::types(['pdf', 'txt'])->max(10 * 1024)],
            'video_link' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
