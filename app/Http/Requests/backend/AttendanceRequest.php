<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'title' => 'required|string|min:6',
            'description' => 'required|string|max:500',
            'start_time' => 'required|date_format:H:i',
            'limit_start_time' => 'required|date_format:H:i|after:start_time',
            'end_time' => 'required|date_format:H:i',
            'limit_end_time' => 'required|date_format:H:i|after:end_time',
            'code' => 'sometimes|nullable',
            'jabatan_ids'  => 'required',
        ];
    }
}
