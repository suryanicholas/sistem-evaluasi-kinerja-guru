<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    
    public function rules() : array
    {
        $rules = [
            "name" => "required|max:120",
            'teaching' => "required",
            'alias' => "required",
            'gender' => "required",
            "code" => "required|numeric|digits:18|unique:teachers,code,".$this->route('teacher')->id,
            "email" => "required|email:rfc|unique:teachers,email,".$this->route('teacher')->id,
            "phone" => "required|numeric|unique:teachers,phone,".$this->route('teacher')->id,
            "address" => "required|max:120"
        ];

        if($this->image){
            $rules['image'] = "image|mimes:png,jpg,jpeg|max:2048";
        }

        return $rules;
    }

    public function messages() : array
    {
        return [
            "*.required" => "Mohon mengisi bagian ini!",
            '*.max' => "Melebihi 120 karakter.",
            'code.unique' => "NIP tersebut sudah terdaftar",
            'code.digits' => "Mohon memasukkan NIP yang valid.",
            'code.numeric' => "NIP harus berupa angka.",
            'email.email' => "Mohon mengisi email yang valid!",
            'email.unique' => "Email tersebut telah digunakan!",
            'phone.numeric' => "Mohon mengisi Nomor HP yang valid!",
            'phone.unique' => "Nomor tersebut telah digunakan!",
            'image.image' => "Hanya gambar yang diperbolehkan.",
            'image.mimes' => "Format gambar yang diterima: JPEG, JPG, dan PNG",
            'image.max' => "Ukuran gambar tidak boleh melebihi 2MB."
        ];
    }
}