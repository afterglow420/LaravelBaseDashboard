<?php

namespace App\Models\Parser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelUpload extends Model
{
    use HasFactory;

    protected $table = 'excel_upload_models';

    protected $primaryKey = 'id';

    protected $fillable = [
        'excel_file_name',
        'excel_file_path',
    ];

    public $timestamps = false;

    public function ExcelUploadedHeaders()
    {
        return $this->hasMany(ExcelUploadedHeaders::class);
    }

    public function ExcelUploadedRows()
    {
        return $this->hasMany(ExcelUploadedRows::class);
    }
}
