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
                                    <li class="breadcrumb-item active" aria-current="page">Articles</li>
                                </ol>
                            </nav>
                            <h2 class="h4">Articles</h2>
                            <p class="mb-0">Detailed articles information.</p>
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
    </div>

    <!-- Table -->
    <div class="mt-2 card card-body border-0 shadow">
        <div class="row mb-2">
            <div class="col md-6">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalAddArticle">
                    Add Article
                </button>
            </div>
        </div>
        <table id="dataTableArticles" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="border-gray-200">Article Id</th>
                    <th class="border-gray-200">Article Title</th>
                    <th class="border-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td class="fw-bold">{{ $article->id_article }}</td>
                        <td>{{ $article->article_title }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning mr-2 mt-1"
                                href="{{ route('articles.show', $article->id_article) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Add Article -->
    <div class="modal fade" id="modalAddArticle" tabindex="-1" aria-labelledby="addArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addArticle">Add Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="article_title" class="form-label">Article Title</label>
                            <input type="text" name="article_title" class="form-control" id="article_title">
                        </div>
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Feature Photo</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="file" type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#dataTableArticles').DataTable({
                    dom: 'Bfrtipl',
                    lengthMenu: [
                        [10, 20, 50, -1],
                        [10, 20, 50, "All"]
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
