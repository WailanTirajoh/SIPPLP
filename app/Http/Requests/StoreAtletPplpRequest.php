<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAtletPplpRequest extends FormRequest
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
            'cabor_id' => 'required|numeric',
            'tanggal_mulai_pplp' => 'required|date',
            // 'tanggal_selesai_pplp' => 'required|date|after:tanggal_mulai_pplp',
        ];
    }
}
