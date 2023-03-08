<x-layouts.app>

    <div class="card mt-2">
        <div class="card-body mt-2 border-0 shadow">
            <div class="row">
                <div class="col-6">
                    <h4><i class="fa-solid fa-list"></i> Edit Row Data</h4>
                </div>
                <div class="col-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body border-0 shadow">
            <form method="POST" action="{{ route('imports.updateRow', $rowId) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                @foreach ($rows as $key => $value)
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">{{ $header[$key] }}</span>
                        <input type="text" class="form-control" name="row[{{ $key }}]"
                            value="{{ $value }}" required>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
            </form>
        </div>
    </div>

</x-layouts.app>
