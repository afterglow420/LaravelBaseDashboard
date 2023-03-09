<x-layouts.app>

    <!-- Table info card -->
    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                            <li class="breadcrumb-item">
                                <a href="#">
                                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Table Name</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Uploaded Tables</h2>
                    <p class="mb-0">Uploaded Tables information panel.</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin: 10px auto; width: 95%">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                @if (session('message'))
                    <div class="alert alert-success p-4" style="margin: 30px auto; width: 95%">
                        <div class="row p-2">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mt-2 card card-body border-0 shadow">
        <div class="row mb-2">
            <div class="col md-6">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalAddTable">
                    Upload excel
                </button>
            </div>
        </div>
        <table id="dataTable" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="border-gray-200">Table Id</th>
                    <th class="border-gray-200">Table Name</th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($imports as $import)
                    <tr>
                        <td class="fw-bold">{{ $import->id }}</td>
                        <td>{{ $import->excel_file_name }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning mr-2 mt-1" href="{{ route('imports.show', $import) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-sm btn-danger mr-2 mt-1" data-bs-toggle="modal"
                                data-bs-target="#modalDeleteTable">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Upload Table -->
    <div class="modal fade" id="modalAddTable" tabindex="-1" aria-labelledby="modalAddTable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTable">Upload new excel file</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('excel-upload') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="excel_file_name" class="form-label">Table name</label>
                            <input type="text" name="excel_file_name" class="form-control" id="excel_file_name">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="col_offset" class="form-label">Col Offset</label>
                                    <input type="text" name="col_offset" class="form-control" id="col_offset"
                                        value="A">
                                    <small style="font-size: 10px;"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="row_offset" class="form-label">Row Offset</label>
                                    <input type="text" name="row_offset" class="form-control" id="row_offset"
                                        value="2">
                                    <small style="font-size: 10px;"></small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="excel_file" class="form-label">Excel file</label>
                            <input type="file" name="excel_file" class="form-control" id="excel_file">
                        </div>
                        <small>Offset represent the start of the table's column and or row. Adjust according to the uploaded table.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Table -->
    @if (isset($import))
        <div class="modal fade" id="modalDeleteTable" tabindex="-1" aria-labelledby="modalDeleteTable"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('imports.destroy', $import) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteTable">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this table?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#dataTable').DataTable({
                    dom: 'Bfrtipl',
                    lengthMenu: [
                        [10, 20, 50, 100, 1000, -1],
                        [10, 20, 50, 100, 1000, "All"]
                    ],
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    colReorder: true,
                    rowReorder: true,
                });
                table.buttons().container().appendTo('#dataTable_wrapper .col-md-6');
            });
        </script>
    @endpush

</x-layouts.app>
