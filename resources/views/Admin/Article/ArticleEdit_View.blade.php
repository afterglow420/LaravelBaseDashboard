<x-layouts.app>
    <div class="card mt-2">
        <div class="card-body mt-2">
            <h4><i class="far fa-newspaper"></i> Article Edit Panel </h4>
            <div class="col-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="col-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body mt-2">
            <form method="POST" action="{{ route('articles.update', $article) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="article_title" class="form-label">Article Title</label>
                        <input type="text" name="article_title" class="form-control" id="article_title"
                            value="{{ $article->article_title }}">
                    </div>
                    <div class="form-group">
                        <label for="article_text">Article Content</label>
                        <textarea id="articleEditor" name="article_text" id="article_text" rows="6" class="form-control">{{ $article->article_text }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Delete Article -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('articles.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        Delete article with title: {{ $article->article_title }} ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea#articleEditor',
                menubar: false,
                plugins: 'code table lists image',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table | image',
            });
        </script>
    @endpush
</x-layouts.app>
