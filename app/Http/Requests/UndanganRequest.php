<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UndanganRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'tema_undangan_id'  => ['required'],
            'nama'              => ['required', 'string', 'max:255', Rule::unique('undangans', 'nama')->ignore($this->undangan)],
            'bg_cover'          => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'cover_dekor_tengah'    => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'file', 'max:2048'],
            'cover_dekor_atas_kanan'    => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'file', 'max:2048'],
            'cover_dekor_atas_kiri'     => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'file', 'max:2048'],
            'cover_dekor_bawah_kanan'   => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'file', 'max:2048'],
            'cover_dekor_bawah_kiri'    => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'file', 'max:2048'],
            'home_dekor_tengah'    => ['nullable', 'image', 'mimes:jpeg,jpg,png',  'file', 'max:2048'],
            'home_dekor_atas_kanan'    => ['nullable', 'image', 'mimes:jpeg,jpg,png',  'file', 'max:2048'],
            'home_dekor_atas_kiri'     => ['nullable', 'image', 'mimes:jpeg,jpg,png',  'file', 'max:2048'],
            'home_dekor_bawah_kanan'   => ['nullable', 'image', 'mimes:jpeg,jpg,png',  'file', 'max:2048'],
            'home_dekor_bawah_kiri'    => ['nullable', 'image', 'mimes:jpeg,jpg,png',  'file', 'max:2048'],
        ];
    }
}
