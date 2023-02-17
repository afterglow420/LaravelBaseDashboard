<x-layouts.app>

    <div class="card mt-2">
        <div class="card-body mt-2">
            <h4><i class="far fa-newspaper"></i> User Edit Panel </h4>
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
            <div class="row">
                <div class="col-8">
                    <form method="POST" action="{{ route('users.update', $user) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input name="name" type="text" name="" class="form-control" id="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" name="" class="form-control" id="email" value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" name="" class="form-control" id="password" value>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password Confirm</label>
                                <input name="password_confirmation" type="password" name="" class="form-control"
                                    id="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalDeleteUser">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete User -->

    <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteUser">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        Delete article with title:?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-layouts.app>