<x-layouts.app>

    <!-- Table info card -->
    <div class="card mt-2">
        <div class="row">
            <div class="col-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="d-block mb-4 mb-md-0">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <svg class="icon icon-xxs" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">CMS</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Media</li>
                                </ol>
                            </nav>
                            <h2 class="h4">Media</h2>
                            <p class="mb-0">Detailed media information.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
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
                        data-bs-target="#modalAddMedia">
                        Add Media
                    </button>
                </div>
            </div>
            <table id="dataTableMedia" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="border-gray-200">Media Id</th>
                        <th class="border-gray-200">Collection Name</th>
                        <th class="border-gray-200">Link</th>
                        <th class="border-gray-200">Preview</th>
                        <th class="border-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medias as $media)
                        <tr>
                            <td class="fw-bold vertical-align">{{ $media->id }}</td>
                            <td class="vertical-align">{{ $media->collection_name }}</td>
                            <td class="vertical-align">
                                @foreach ($media->custom_properties as $key => $value)
                                    <input type="text" value="{{ $value }}" id="{{ $media->uuid }}" readonly>
                                @endforeach
                            </td>
                            <td class="vertical-align">
                                <img src="{{ $media->getUrl() }}" alt="" width="75px">
                            <td class="vertical-align">
                                <button class="btn btn-sm btn-outline-success mr-2 mt-1" id="notifyTopLeft"
                                    onclick="copyUrlOnClick('{{ $media->uuid }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <a class="btn btn-sm btn-outline-danger mr-2 mt-1" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMedia" href="{{ route('medias.destroy', $media) }}">
                                    <i class="fas fa-trash"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Add Media -->

        <div class="modal fade" id="modalAddMedia" tabindex="-1" aria-labelledby="modalAddMedia" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddMedia">Add new Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('medias.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="media_name" class="form-label">Media Name</label>
                                <input type="text" name="media_name" class="form-control" id="media_name">
                            </div>
                            <div class="mb-3">
                                <label for="media_photo" class="form-label">Media Photo</label>
                                <input type="file" name="file" class="form-control" id="file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Media -->

        <div class="modal fade" id="modalDeleteMedia" tabindex="-1" aria-labelledby="modalDeleteMedia"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteMedia">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('medias.destroy', $media) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-body">
                            Are you sure you want to delete this media resource ?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    var table = $('#dataTableMedia').DataTable({
                        dom: 'frtipl',
                        lengthMenu: [
                            [10, 20, 50, -1],
                            [10, 20, 50, "All"]
                        ],
                        colReorder: true,
                        rowReorder: true,
                    });
                    table.buttons().container().appendTo('#dataTable_wrapper .col-md-6');
                });
            </script>

            <script>
                function copyUrlOnClick(id) {
                    var copyText = document.getElementById(id);
                    copyText.select();
                    document.execCommand("copy");
                    const notyf = new Notyf({
                        position: {
                            x: 'right',
                            y: 'top',
                        },
                        types: [{
                            type: 'info',
                            background: '#10B981',
                            icon: {
                                className: 'fas fa-info-circle',
                                tagName: 'span',
                                color: 'white'
                            },
                            dismissible: false
                        }]
                    });
                    notyf.open({
                        type: 'info',
                        message: 'The resource link has been copied to your clipboard'
                    });
                }
            </script>
        @endpush

</x-layouts.app>
