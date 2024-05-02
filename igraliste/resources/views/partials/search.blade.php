<div class="container pt-4 pe-3">
    <div class="d-flex mb-3 justify-content-between">
        <div class="search-container shadow-sm mb-1">
            <input type="search" class="search-input" placeholder="Пребарувај..." id="search" data-url="{{ explode('/', request()->path())[0] }}">
            <i class="fas fa-search search-icon border-0"></i>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chevron-down border-0"></i>
                </button>
                <ul class="dropdown-menu">
                    <!-- Dropdown items -->
                </ul>
            </div>
        </div>
        @if(Request::url() == url('/'))
        <div class="ms-2 d-flex align-items-center toggle-triggers">
            <div class="ms-2 d-flex align-items-center toggle-triggers rounded-3">
                <div class="d-flex align-items-center shadow-sm border rounded-3 p-1 me-2">
                    <img src="{{ asset('images/grid-icon.svg') }}" alt="" class="disable-expand grid-trigger">
                </div>
                <div class="d-flex align-items-center shadow-sm border rounded-3 p-1 active">
                    <img src="{{ asset('images/list-icon.svg') }}" alt="" class="disable-expand list-trigger">
                </div>
            </div>
        </div>
        @endif
    </div>
</div>