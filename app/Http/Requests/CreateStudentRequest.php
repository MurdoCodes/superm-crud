<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'fullname' => 'required|string',
            'contact' => 'required|string',
            'region' => 'required|string',
            'course_id' => 'required|integer',
            'section_id' => 'required|integer',
            'status_id' => 'required|integer',
        ];
    }
}
