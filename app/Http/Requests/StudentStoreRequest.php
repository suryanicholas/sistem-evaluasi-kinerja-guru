<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StudentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules() : array
    {
        return [
            'code' => "required|digits:10|unique:students,code",
            'name' => "required|max:120",
            'gender' => "required",
            'birthPlace' => "required|max:50",
            'birthDate' => "required|date|before_or_equal:today",
            'room' => 'required',
            'fatherName' => 'required|max:120',
            'motherName' => 'required|max:120',
            'fatherJob' => 'required|max:120',
            'motherJob' => 'required|max:120',
            'wali' => 'nullable|max:120',
            'phone' => 'required|numeric',
            'address' => 'required|max:120',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function messages() : array
    {
        return [
            '*.required' => "Mohon mengisi bagian ini.",
            'code.unique' => "NISN ini telah digunakan",
            'code.digits' => "Format NISN tidak dikenali!",
            'name.max' => "Maksimal 120 Karakter",
            'birthPlace.max' => "Maksimal 50 Karakter",
            'birthDate.date' => "Tanggal tidak valid",
            'birthDate.before_or_equal' => "Mohon mengisi Tanggal yang valid.",
            'fatherName.max' => "Maksimal 120 Karakter",
            'motherName.max' => "Maksimal 120 Karakter",
            'fatherJob.max' => "Maksimal 120 Karakter",
            'motherJob.max' => "Maksimal 120 Karakter",
            'wali.max' => "Maksimal 120 Karakter",
            'phone.numeric' => "Gunakan angka 0-9.",
            'address.max' => "Maksimal 120 Karakter",
            'image.image' => "Pilih gambar yang valid (Max. 2MB). Format: .JPG, .JPEG, .PNG",
            'image.mimes' => "Pilih gambar yang valid (Max. 2MB). Format: .JPG, .JPEG, .PNG",
            'image.max' => "Gambar yang anda pilih melebihi Batas Maksimum"
        ];
    }
}