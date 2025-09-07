<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'tel1' => ['required', 'digits_between:1,5'],
            'tel2' => ['required', 'digits_between:1,5'],
            'tel3' => ['required', 'digits_between:1,5'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'max:255'],
            'category_type' => ['required', 'exists:categories,id'],
            'detail' => ['required', 'string', 'max:120'],         
        ];
    }

    
    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'first_name.string' => '姓は文字列で入力してください',
            'first_name.max' => '姓は255文字以内で入力してください',

            'last_name.required' => '名を入力してください',
            'last_name.string' => '名は文字列で入力してください',
            'last_name.max' => '名は255文字以内で入力してください',

            'gender.required' => '性別を選択してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスは255文字以内で入力してください',

            'tel1.required' => '電話番号を入力してください。',
            'tel1.digits_between' => '電話番号は5桁までの数字を入力してください',

            'tel2.required' => '電話番号を入力してください。',
            'tel2.digits_between' => '電話番号は5桁までの数字を入力してください',

            'tel3.required' => '電話番号を入力してください。',
            'tel3.digits_between' => '電話番号は5桁までの数字を入力してください',

            'address.required' => '住所を入力してください',
            'address.string' => '住所は文字列で入力してください',
            'address.max' => '住所は255文字以内で入力してください',

            'building.max' => '建物名は255文字以内で入力してください',

            'category_type.required' => 'お問い合わせの種類を選択してください。',
            'category_type.exists' => '選択されたお問い合わせの種類は存在しません',

            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容は文字列で入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
