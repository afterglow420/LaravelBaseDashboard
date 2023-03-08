<?php

namespace App\Http\Requests\Parser;

use Illuminate\Foundation\Http\FormRequest;

class ExcelUploadRequest extends FormRequest
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
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'excel_file_name' => 'required|string|max:255',
            'col_offset' => 'required|string|max:1',
            'row_offset' => 'required|integer',
        ];
    }
}
