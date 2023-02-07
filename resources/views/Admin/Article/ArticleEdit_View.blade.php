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
        <script src="{{ URL::to('assets/js/tinymce/tinymce.min.js') }}"></script>
        <script>
            const uploadPromise = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            var urlPost = "{{ route('articles.upload') }}"
            xhr.open('POST', urlPost);
            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status === 403) {
                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
                }

                resolve(json.location);
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        });
    tinymce.init({
        selector: '#articleEditor',
        width: '100%',
        height: 700,
        plugins: 'image code',
        browser_spellcheck: true,
        menu: {
            file: {
                title: 'File',
                items: 'newdocument restoredraft | preview | print'
            },
            edit: {
                title: 'Edit',
                items: 'undo redo | cut copy paste | selectall | searchreplace'
            },
            view: {
                title: 'View',
                items: 'code | visualaid visualchars visualblocks | preview fullscreen'
            },
            insert: {
                title: 'Insert',
                items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime'
            },
            format: {
                title: 'Format',
                items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
            }
        },
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
        branding: false,
        mobile: {
            menubar: true
        },
        images_upload_handler: uploadPromise
    });
        </script>
    @endpush
</x-layouts.app>
