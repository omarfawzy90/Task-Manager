<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description'=>  'nullable|string|max:150',
            'priority' => 'required|in:high,medium,low',
        ];
    }

    public function messages()
    {
        return $messages = [
            'title.required' => 'The title is required',
            'title.string' => 'The title must be words',
            'title.max' => 'The title must not exceed 50 charactars',
        ];
    }
}
