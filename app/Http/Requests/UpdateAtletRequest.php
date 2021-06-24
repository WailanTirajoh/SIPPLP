<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAtletRequest extends FormRequest
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
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Kristen,Katholik,Konghucu,Budha,Islam',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'avatar' => 'nullable',

            // Alamat
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kel_desa' => 'required',
            'kecamatan' => 'required',
        ];
    }
}
