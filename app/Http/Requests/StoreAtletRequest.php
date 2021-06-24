<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAtletRequest extends FormRequest
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
            // User & Atlet
            'name' => 'required|string',
            'email'  => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Kristen,Katholik,Konghucu,Budha,Islam',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'avatar' => 'nullable',

            // Cabang Olahraga
            'cabor_id' => 'required|numeric',
            'tanggal_mulai_pplp' => 'required|date',
            'tanggal_selesai_pplp' => 'date|nullable|after:tanggal_mulai_pplp',

            // Fisik
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric',

            // Alamat
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kel_desa' => 'required',
            'kecamatan' => 'required',

            // Sekolah
            'sekolah_id' => 'required|numeric',
            'tanggal_mulai_sekolah' => 'required|date',
            'tanggal_selesai_sekolah' => 'date|nullable|after:tanggal_mulai_sekolah',
            'masuk_kelas' => 'required|numeric|in:1,2,3'
        ];
    }
}
