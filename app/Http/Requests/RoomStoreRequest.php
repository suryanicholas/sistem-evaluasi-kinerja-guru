<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class RoomStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules() : array
    {
        
        return [
            "name" => "required|max:120",
            "teacher" => ['required',
            function ($attribute, $value, $fail) {
                $teacherId = Teacher::where('code', $value)->value('id');
                if (!$teacherId) {
                    $fail('ERROR');
                    return;
                }

                $exists = DB::table('rooms')->where('teacher_id', $teacherId)->exists();
                if ($exists) {
                    $fail('Guru ini telah menjadi Wali Kelas lain.');
                }
            },
            ]
        ];
    }

    public function messages() : array
    {
        return [
            "*.required" => "Mohon mengisi bagian ini!",
            '*.max' => "Melebihi 120 karakter."
        ];
    }
}