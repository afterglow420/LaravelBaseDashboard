<?php

namespace App\Models\Parser;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExcelUploadedRows extends Model
{
    use HasFactory;

    protected $table = 'excel_uploaded_rows';

    protected $primaryKey = 'id';

    protected $fillable = [
        'row_data',
        'excel_uploaded_headers_id',
        'excel_upload_model_id'
    ];

    public $timestamps = false;

    public function ExcelUploadedHeaders()
    {
        return $this->belongsTo(ExcelUploadedHeaders::class);
    }

    public function ExcelUpload()
    {
        return $this->belongsTo(ExcelUpload::class);
    }

    public static function extractRowData($excelUploadedHeadersId, $colOffset, $rowOffset)
    {
        $excelUploadedHeaders = ExcelUploadedHeaders::find($excelUploadedHeadersId);
        $uploadModel = ExcelUpload::find($excelUploadedHeaders->excel_upload_model_id);
        $path = $uploadModel->excel_file_path;
        $spreadsheet = IOFactory::load(storage_path('app/public/' . $path));
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        for ($row = $rowOffset + 1; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray($colOffset . $row . ':' . $worksheet->getHighestColumn() . $row, NULL, TRUE, FALSE);
            $excelUploadedRows = new self();
            $excelUploadedRows->row_data = json_encode($rowData[0]);
            $excelUploadedRows->excel_uploaded_headers_id = $excelUploadedHeadersId;
            $excelUploadedRows->excel_upload_model_id = $excelUploadedHeaders->excel_upload_model_id;
            $excelUploadedRows->save();
        }
    }
}
