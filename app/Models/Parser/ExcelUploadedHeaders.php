<?php

namespace App\Models\Parser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelUploadedHeaders extends Model
{
    use HasFactory;

    protected $table = 'excel_uploaded_headers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'column_headers',
        'excel_upload_id',
    ];

    public $timestamps = false;

    public function ExcelUpload()
    {
        return $this->belongsTo(ExcelUpload::class);
    }

    public function ExcelUploadedRows()
    {
        return $this->hasMany(ExcelUploadedRows::class);
    }

    public static function extractColumnHeaders($excelUploadModelId, $colOffset)
    {
        $uploadModel = ExcelUpload::find($excelUploadModelId);
        $path = $uploadModel->excel_file_path;
        $spreadsheet = IOFactory::load(storage_path('app/public/' . $path));
        $worksheet = $spreadsheet->getActiveSheet();
        $highestColumn = $worksheet->getHighestColumn();
        $headers = [];

        for ($column = $colOffset; $column <= $highestColumn; $column++) {
            $columnCell = $worksheet->getCell($column . '1')->getValue();
            
            if(!empty($columnCell)) {
                $headers[] = $columnCell;
            }
        }

        $excelUploadedHeaders = new self();
        $excelUploadedHeaders->column_headers = json_encode($headers);
        $excelUploadedHeaders->excel_upload_id = $excelUploadModelId;
        $excelUploadedHeaders->save();
    }
}
