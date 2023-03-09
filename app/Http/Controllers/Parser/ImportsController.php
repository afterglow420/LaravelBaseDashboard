<?php

namespace App\Http\Controllers\Parser;

use Illuminate\Http\Request;
use App\Models\Parser\ExcelUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\ExcelRowUpdateRequest;
use App\Http\Requests\Parser\ExcelUpdateTableNameRequest;
use App\Models\Parser\ExcelUploadedRows;
use App\Models\Parser\ExcelUploadedHeaders;
use Termwind\Components\Dd;

class ImportsController extends Controller
{
    public function index()
    {
        return view('Parser.ParserIndex_View', ['imports' => ExcelUpload::all()]);
    }
    
    public function show($import)
    {
        $import = ExcelUpload::find($import);
        $headers = ExcelUploadedHeaders::where('excel_upload_id', $import->id)->first();
        $rows = ExcelUploadedRows::where('excel_uploaded_headers_id', $headers->id)->get();

        $rowData = [];

        $x = 0;
        foreach ($rows as $row) {
            $rowDecoded = json_decode($row->row_data, true);
            $rowData[$x]['data'] = $rowDecoded;
            $rowData[$x]['id'] = $row['id'];
            $x++;
        }
        
        $data = [
            'headers' => json_decode($headers['column_headers'], true),
            'rows' => $rowData,
            'import' => $import,
        ];

        return view('Parser.ParserEdit_View', $data);
    }

    public function update(ExcelUpdateTableNameRequest $request, ExcelUpload $import)
    {
        $import->fill($request->validated())->save();

        return redirect()->route('imports.show', $import)->with('message', 'Table name updated successfully');
    }

    public function showRow($id)
    {
        $row = ExcelUploadedRows::find($id);
        $rows = json_decode($row['row_data'], true);
        // dd($rows);        
        $header = ExcelUploadedHeaders::find($row->excel_uploaded_headers_id);
        
        $data = [
            'header' => json_decode($header['column_headers'], true),
            'rows' => $rows,
            'rowId' => $id,
        ];

        return view('Parser.ParserEditRow_View', $data);
    }

    public function updateRow(Request $request, $rowId)
    {
        $data = json_encode($request->row);
        $model = ExcelUploadedRows::find($rowId);

        $model->row_data = $data;
        $model->save();

        return redirect()->route('imports.showRow', $rowId)->with('message', 'Row Successfully updated');
    }

    public function destroy(ExcelUpload $import)
    {
        $import->ExcelUploadedHeaders()->delete();
        $import->ExcelUploadedRows()->delete();
        $import->delete();

        return redirect()->route('imports.index')->with('message', 'Table deleted successfully');
    }

    public function destroyRow($rowId)
    {
        $row = ExcelUploadedRows::find($rowId);
        $import = ExcelUpload::find($row->ExcelUploadedHeaders->excel_upload_id);
        $row->delete();

        return redirect()->route('imports.show', $import)->with('message', 'Row deleted successfully');
    }
}
