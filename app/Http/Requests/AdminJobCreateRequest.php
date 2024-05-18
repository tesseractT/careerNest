<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminJobCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'integer', 'exists:companies,id'],
            'category' => ['required', 'integer', 'exists:job_categories,id'],
            'vacancies' => ['required', 'max:255'],
            'deadline' => ['required', 'date'],
            'country' => ['nullable', 'integer', 'exists:countries,id'],
            'state' => ['nullable', 'integer', 'exists:states,id'],
            'city' => ['nullable', 'integer', 'exists:cities,id'],
            'address' => ['nullable', 'string', 'max:255'],
            'salary_mode' => ['required', 'string', 'in:range,custom'],
            'min_salary' => ['nullable', 'numeric'],
            'max_salary' => ['nullable', 'numeric'],
            'custom_salary' => ['nullable', 'string', 'max:255'],
            'salary_type' => ['required', 'integer', 'exists:salary_types,id'],
            'experience' => ['required', 'integer', 'exists:job_experiences,id'],
            'job_role' => ['required', 'integer', 'exists:job_roles,id'],
            'education' => ['required', 'integer', 'exists:education,id'],
            'job_type' => ['required', 'integer', 'exists:job_types,id'],
            'tags' => ['required'],
            'benefits' => ['required'],
            'skills' => ['required'],
            'receive_application' => ['required', 'in:email,website,custom_url'],
            'description' => ['required'],
        ];
    }
}
