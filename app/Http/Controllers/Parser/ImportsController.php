<?php

namespace App\Http\Controllers\Parser;

use Illuminate\Http\Request;
use App\Models\Parser\ExcelUpload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\FilterController;
use App\Http\Requests\Filters\FilterRequest;
use App\Http\Requests\Parser\ExcelUpdateTableNameRequest;
use App\Models\Parser\ExcelUploadedRows;
use App\Models\Parser\ExcelUploadedHeaders;
use DeepCopy\Filter\Filter;


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
        $uniqueCountries = [];
        $rowData = [];
        $uniqueGender = [];
        $x = 0;

        foreach ($rows as $row) {
            $rowDecoded = json_decode($row->row_data, true);
            $headersDecoded = json_decode($headers->column_headers, true);
            $gender = $rowDecoded[array_search('Gender', $headersDecoded)];
            $country = $rowDecoded[array_search('Country', $headersDecoded)];

            if (!in_array($country, $uniqueCountries)) {
                $uniqueCountries[] = $country;
            }

            if (!in_array($gender, $uniqueGender)) {
                $uniqueGender[] = $gender;
            }

            $rowData[$x]['data'] = $rowDecoded;
            $rowData[$x]['id'] = $row['id'];
            $x++;
        }

        $data = [
            'headers' => json_decode($headers['column_headers'], true),
            'rows' => $rowData,
            'import' => $import,
            'uniqueCountries' => $uniqueCountries,
            'uniqueGenders' => $uniqueGender,
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
        $header = ExcelUploadedHeaders::find($row->excel_uploaded_headers_id);

        $data = [
            'header' => json_decode($header['column_headers'], true),
            'rows' => $rows,
            'rowId' => $id,
        ];

        return view('Parser.ParserEditRow_View', $data);
    }

    public function showSearchResult(FilterRequest $request)
    {
        $search = $request->input('search');
        $filters['gender'] = $request->input('filters_gender');
        $filters['country'] = $request->input('filters_country');
        $filteredData = ExcelUploadedRows::filterData($search, $filters);
        $result = [];
        $x = 0;

        if ($filteredData->first()) {
            $headers = json_decode(ExcelUploadedHeaders::find($filteredData[0]->excel_uploaded_headers_id)->column_headers);
            foreach ($filteredData as $rowData) {
                $result[] = json_decode($rowData['row_data'], true);
                $result[$x]['id'] = $rowData['id'];
                $x++;
            }

            $data = [
                'headers' => $headers,
                'rows' => $result,
            ];

            return  view('Parser.ParserShowSearchResult_View', $data);
        } else {
            return redirect()->route('imports.index')->with('message', 'No results found');
        }
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
