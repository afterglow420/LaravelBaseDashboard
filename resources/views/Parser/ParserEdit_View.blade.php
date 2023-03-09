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
                    data-bs-target="#editTableName">
                    Edit Table Name
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addEntry">
                    Add table entry
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="table table-hover table-striped">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th class="border-gray-200">{{ $header }}</th>
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $index => $row)
                        <tr>
                            @foreach ($row['data'] as $celldata)
                                <td>{{ $celldata }}</td>
                            @endforeach
                            <td>
                                <a class="btn btn-sm btn-warning mr-2 mt-1"
                                    href="{{ route('imports.showRow', $row['id']) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-sm btn-danger mr-2 mt-1" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteRow">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Table Name-->
    <div class="modal fade" id="editTableName" tabindex="-1" aria-labelledby="editTableName" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('imports.update', $import) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editTableName">Edit Table Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="excel_file_name" class="form-label">Table Name</label>
                            <input type="text" class="form-control" id="excel_file_name" name="excel_file_name"
                                value="{{ $import->excel_file_name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (isset($row))
        <div class="modal fade" id="modalDeleteRow" tabindex="-1" aria-labelledby="modalDeleteRow"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('imports.destroyRow', $row['id']) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteRow">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this row?</p>
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
