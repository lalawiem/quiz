<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DuyuruUpdateRequest extends FormRequest
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
            'title'=>'required|min:3|max:200',
            'finished_at'=>'nullable|after:'.now()
            


        ];
    }

    public function attributes()
    {
        return [
            'title'=>'Duyuru',
            'finished_at'=>'Bitiş Tarihi'
        ];
    }
}