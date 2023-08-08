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
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'created_by'  => 'required|exists:users,id',
            'assigned_to' => 'required|exists:users,id',
            'title'       => 'required|string|min:1|max:255',
            'description' => 'required|string|min:1|max:1000',
            'progress'    => 'required|string|in:to_do,in_progress,need_review,done',
            'category_id' => 'required|exists:task_categories,id',
        ];
    }
}
