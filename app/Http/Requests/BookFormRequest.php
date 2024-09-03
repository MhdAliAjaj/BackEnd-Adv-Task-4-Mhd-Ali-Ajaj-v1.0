<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookFormRequest extends FormRequest
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
            'title' => 'required|string',
            'author' => 'required|string|min:3',
            'description' => 'required|string',
            'published_at' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'اسم الكتاب',
            'author' => 'اسم المؤلف',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'اسم الكتاب مطلوب',
            'author.min' => 'اسم المؤلف يجب أن يحتوي على أكثر من 3 حروف',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    protected function passedValidation()
{
    // تنفيذ عمليات إضافية مثل التسجيل أو إرسال تنبيه
}
}
