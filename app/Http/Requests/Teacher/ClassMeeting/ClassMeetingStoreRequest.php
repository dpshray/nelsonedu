<?php

namespace App\Http\Requests\Teacher\ClassMeeting;

use Illuminate\Foundation\Http\FormRequest;

class ClassMeetingStoreRequest extends FormRequest
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
            'topic' => ['required', 'string', 'max:255'],
            'start_date_time' => ['required', 'date_format:Y-m-d\TH:i'],
            // 'start_date_time' => ['required', 'date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM)],
            'recurring_meeting' => ['sometimes', 'nullable', 'boolean'],
            'recurrence' => ['required_with:recurring_meeting', 'integer', 'min:1', 'max:3'],
            'repeat_interval' => ['required_with:recurring_meeting', 'integer', 'min:1', 'max:10'],
            'end_time_after' => ['required_with:recurring_meeting', 'integer', 'min:1', 'max:10'],
            'duration' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:5', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'start_date_time.date_format' => 'Datetime should be after the current time',
        ];
    }
}
