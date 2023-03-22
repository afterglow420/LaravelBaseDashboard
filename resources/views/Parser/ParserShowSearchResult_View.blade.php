<x-layouts.app>

    <div class="card mt-2">
        <div class="card-body">
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
                        <li class="breadcrumb-item"><a href="#">Search Results</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                    </ol>
                </nav>
                <h2 class="h4">Search Results</h2>
                <p class="mb-0">Search Results information panel.</p>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="#" class="table table-hover table-striped">
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
                                @foreach ($row as $celldata)
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
    </div>

</x-layouts.app>