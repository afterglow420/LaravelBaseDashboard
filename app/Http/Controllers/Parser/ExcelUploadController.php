<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\ExcelUploadRequest;
use App\Models\Parser\ExcelUpload;
use App\Models\Parser\ExcelUploadedHeaders;
use App\Models\Parser\ExcelUploadedRows;

class ExcelUploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ExcelUploadRequest $request)
    {
        $path = $request->file('excel_file')->store('excel_uploads', 'public');
        $colOffset = $request->col_offset;
        $rowOffset = $request->row_offset;
        $data = $request->validated();
        $data['excel_file_path'] = $path;
        
        // dd($request->all());

        ExcelUpload::create($data);
        $uploadModelId = ExcelUpload::where('excel_file_path', $path)->first()->id;

        ExcelUploadedHeaders::extractColumnHeaders($uploadModelId, $colOffset);
        $uploadedHeaderId = ExcelUploadedHeaders::where('excel_upload_id', $uploadModelId)->first()->id;

        ExcelUploadedRows::extractRowData($uploadedHeaderId, $colOffset, $rowOffset);

        return redirect()->route('imports.index')->with('message', 'File uploaded successfully');
    }
}
