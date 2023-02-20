@props([
    'title' => '',
    'subtitle' => '',
    'crumb' => '',
    'crumbtitle' => '',
    'endcrumb' => '',
]);

<div>
    <div class="col-4">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <div class="d-block mb-4 mb-md-0">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                            <li class="breadcrumb-item">
                                <a href="#dashboard">
                                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            @if ($crumbtitle)
                                <li class="breadcrumb-item"><a href="{{ $crumb }}">{{ $crumbtitle }}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">{{ $endcrumb }}</li>
                        </ol>
                    </nav>
                    <h2 class="h4">{{ $title }}</h2>
                    <p class="mb-0">{{ $subtitle }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
