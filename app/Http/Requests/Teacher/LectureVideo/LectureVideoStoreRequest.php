<?php

namespace App\Http\Requests\Teacher\LectureVideo;

use Illuminate\Foundation\Http\FormRequest;

class LectureVideoStoreRequest extends FormRequest
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
            // 'file' => ['required', 'string', 'max:2000'],
            'link' => ['required', 'string', 'max:5000'],
        ];
    }
}
