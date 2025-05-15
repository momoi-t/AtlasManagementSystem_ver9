<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'over_name' => ['required', 'string', 'max:10'],
            'under_name' => ['required', 'string', 'max:10'],
            'over_name_kana' => ['required', 'string', 'regex:/^[ァ-ヶー]+$/u', 'max:30'],
            'under_name_kana' => ['required', 'string', 'regex:/^[ァ-ヶー]+$/u', 'max:30'],
            'mail_address' => ['required', 'string', 'email', 'max:100', 'unique:users,mail_address'],
            'sex' => ['required', Rule::in([1, 2, 3])],
            'old_year' => ['required','numeric'],
            'old_month' => ['required','numeric'],
            'old_day' => ['required','numeric'],
            'birth_day' => ['required', 'date', 'after_or_equal:2000-01-01', 'before_or_equal:today'],
            'role' => ['required', Rule::in([1, 2, 3, 4])],
            'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed'],
        ];
    }

    //生年月日をまとめてバリデーション
    protected function prepareForValidation()
    {
        if ($this->filled(['old_year', 'old_month', 'old_day'])) {
            $dateString = sprintf('%04d-%02d-%02d', $this->old_year, $this->old_month, $this->old_day);
            $this->merge(['birth_day' => $dateString]);
        }
    }
}
