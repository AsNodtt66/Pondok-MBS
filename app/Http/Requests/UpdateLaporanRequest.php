<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah menjadi logika otorisasi jika diperlukan
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'Jenis_laporan' => 'required|integer',
            'Tanggal_generate' => 'required|date',
            'Tanggal_lapor' => 'nullable|date',
            'File_path' => 'required|string',
            'Pembuat_id' => 'required|exists:penggunas,id',
        ];
    }
}